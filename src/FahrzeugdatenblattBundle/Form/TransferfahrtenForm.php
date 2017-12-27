<?php

namespace FahrzeugdatenblattBundle\Form;

use FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt;
use FahrzeugdatenblattBundle\Repository\FahrzeugdatenblattRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class TransferfahrtenForm extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('startDestination')
			->add('finishDestination')
			->add('distance')
			->add('duration')
			->add('fahrzeuge', EntityType::class, [
				'class' => Fahrzeugdatenblatt::class,
				'query_builder' => function(FahrzeugdatenblattRepository $repository){
					return $repository->sortCarsAlphabetical();
				},
				'placeholder' => 'Choose an option'
			] )
			->add('isPublished', ChoiceType::class, [
				'choices'  => [
					'Maybe' => null,
					'Yes' => true,
					'No' => false
				]])
			->add('createdAt', DateType::class, [
				'widget' => 'single_text',
				'html5' => false,
				'attr' => [
					'class' => 'datepicker'
				]
			]);

	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'FahrzeugdatenblattBundle\Entity\Transferfahrten'
		]);
	}

	public function getBlockPrefix()
	{
		return 'fahrzeugdatenblatt_bundle_transferfahrten_form';
	}
}
