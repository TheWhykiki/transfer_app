<?php

namespace FahrzeugdatenblattBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FahrzeugdatenForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('fahrzeugMarke')
			->add('fahrzeugModell')
			->add('fahrzeugKategorie')
			->add('personenMax')
			->add('preisKm')
			->add('preisStunde')
			->add('preisGrund')
			->add('bildFahrzeug')
			->add('zusatzinfos');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
		$resolver->setDefaults([
			'data_class' => 'FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt'
		]);
    }

    public function getBlockPrefix()
    {
        return 'fahrzeugdatenblatt_bundle_fahrzeugdaten_form';
    }
}
