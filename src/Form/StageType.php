<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Formation;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('mission', TextareaType::class)
            ->add('adresseMail')
            ->add('entreprises',  Entreprise1Type::class)
            ->add('Formation', EntityType::class, array(
                'class' => Formation::class,
                'choice_label' => 'nom',

                'multiple' => 'true',
                'expanded' => 'true',
            ))
            ;

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
