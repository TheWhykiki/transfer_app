<?php

namespace FahrzeugdatenblattBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AnfrageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    $builder
		    ->add('createdAt', DateType::class, [
			    'widget' => 'single_text',
			    'html5' => false,
			    'attr' => [
				    'class' => 'dateGetter'
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
        return 'fahrzeugdatenblatt_bundle_anfrage_form';
    }
}
