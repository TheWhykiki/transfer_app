<?php

namespace FahrzeugdatenblattBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;


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
			->add('imageFile', VichFileType::class, [
				'required' => false,
				'allow_delete' => true,
			])
			//->add('bildFahrzeug', FileType::class, array('label' => 'Brochure (PDF file)'))
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
