<?php

namespace FahrzeugdatenblattBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorInformationsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('name')
			->add('address')
			->add('zip')
			->add('city')
			->add('email')
			->add('phone')
			->add('mobile')
			->add('taxid');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
		$resolver->setDefaults([
			'data_class' => 'FahrzeugdatenblattBundle\Entity\VendorInformations'
		])
    }

    public function getBlockPrefix()
    {
        return 'fahrzeugdatenblatt_bundle_vendor_informations_form';
    }
}
