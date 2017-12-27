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
		    ->add('startTime', DateType::class, [
			    'widget' => 'single_text',
			    'html5' => false,
			    'attr' => [
				    'class' => 'dateGetter'
			    ]
		    ])
		    ->add('startDestination', DateType::class, [
		    'widget' => 'single_text',
		    'html5' => false,
		    'attr' => [
			    'class' => 'inputbox text placeholderNeu requiredInput',
			    'id' => 'textfeld_abfahrt',
			    'placeholder' => 'von (Adresse, Flughafen, Hotel...)'
		        ]
	        ])
		    ->add('finishDestination', DateType::class, [
			    'widget' => 'single_text',
			    'html5' => false,
			    'attr' => [
				    'class' => 'inputbox text placeholderNeu requiredInput',
				    'id' => 'textfeld_ziel',
				    'placeholder' => 'nach (Adresse, Flughafen, Hotel...)'
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
