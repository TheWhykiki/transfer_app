<?php

namespace FahrzeugdatenblattBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransferfahrtenForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('startDestination')
			->add('finishDestination')
			->add('distance')
			->add('duration')
			->add('fahrzeuge')
			->add('createdAt');
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
