<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class Client extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class , ['label' => 'Kód země'])
            ->add('phone', TextType::class , ['label' => 'Telefon (9 čísel bez mezer)'])
            ->add('firstname', TextType::class, ['label' => 'Jméno'])
            ->add('lastname', TextType::class, ['label' => 'Přijmení'])
            ->add('minutesCalled', TextType::class, ['label' => 'Provolané minuty'])
            ->add('agree', ChoiceType::class, [
                'choices'  => [
                    'Yes' => 'Ano',
                    'No' => 'Ne',
                ], 'label' => 'Souhlasí se smlouvou'
            ])
            ->add('save', SubmitType::class, ['label' => 'Uložit klienta']);
    }
}
?>