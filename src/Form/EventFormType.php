<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\Rank;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('imageFile', FileType::class, [
                'required' => false,
            ])
            ->add('name')
            ->add('description')
            ->add('cashprize')
            ->add('date_start', null, [
                'widget' => 'single_text',
            ])
            ->add('date_start_inscrip', null, [
                'widget' => 'single_text',
            ])
            ->add('date_end_inscrip', null, [
                'widget' => 'single_text',
            ])
            ->add('date_end', null, [
                'widget' => 'single_text',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
