<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',
                TextType::class,[
                    "label"=>"Title ",
                    "attr"=>[
                        "placeholder"=>"Title ..."
                    ]
                ]
            )
            ->add('description',TextareaType::class,[
                "label"=>"Description ",
                    "attr"=>[
                        "placeholder"=>"Description ..."
                    ]
            ])
            ->add('surface',NumberType::class,[
                "label"=>"Surface ",
                    "attr"=>[
                        "placeholder"=>"Surface ..."
                    ]
                ]
            )
            ->add('rooms',NumberType::class,[
                "label"=>"Rooms ",
                "attr"=>[
                    "placeholder"=>"Number of rooms ..."
                ]
            ])
            ->add('bedrooms',NumberType::class,[
                "label"=>"Bedrooms ",
                "attr"=>[
                    "placeholder"=>"Number of bedrooms ..."
                ]
            ])
            ->add('floor',NumberType::class,[
                "label"=>"Floor ",
                    "attr"=>[
                        "placeholder"=>"Floor ..."
                    ]
            ])
            ->add('price',NumberType::class,[
                "label"=>"Price ",
                    "attr"=>[
                        "placeholder"=>"Price in € ..."
                    ]
            ])
            ->add('heat',ChoiceType::class,[
                "label"=>'Type of heat',
                "choices"=>$this->getChoices()
            ])
            ->add('city',TextType::class,[
                "label"=>"Title ",
                "attr"=>[
                    "placeholder"=>"Title ..."
                ]
            ]
            )
            ->add('adress',TextType::class,[
                "label"=>"Adress ",
                "attr"=>[
                    "placeholder"=>"Adress ..."
                ]
            ])
            ->add('postalCode',TextType::class,[
                "label"=>"Postal code ",
                "attr"=>[
                    "placeholder"=>"Postal code ..."
                ]
            ])
            ->add('sold'
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }

    public function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];

        foreach ($choices as $key => $value) {
            $output[$value] = $key;
        }
        return $output;
    }
}
