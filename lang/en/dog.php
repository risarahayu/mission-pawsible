<?php

return [
    'title' => "Let's save the dog",
    'sub_title' => 'You can adopt some of them or you also can register your dog to find new adopter',
    'sub_title_request' => 'We will assist in rescuing the dog you find on the street',
    'alert' => "Hey there! The dogs featured on our website are all vaccinated and sterilized.<br> They're ready for a loving home!",

    // index
    'index' => [
        'count' => 'We found :count at :area stray dog',
        'all_count' => 'We found :count stray dog at All area',
        'empty' => 'No stray dog yet',
        'empty_adopted_dog' => 'No dogs have been adopted yet',
        'empty_rescued_dog' => 'No dogs have been rescued yet',
        'register' => 'Register a stray dog',
        'filter' => 'Filter',
        'all' => 'All',
        'request_by' => 'Request by :count people',
        'since' => 'Since :date',
        'adoptable' => 'Adoptable',
        'adopted' => 'Adopted',
        'pending' => 'Waiting for approval',
        'see_detail' => 'See Detail',
        'rescued_date' => 'Rescued',
    ],

    'show' => [
        'title' => 'Dog Information',
        'no_adopter' => 'No adopter yet',
        'registered_by' => 'Registered by',
        'adopters' => 'Adopters',

        'already_adopted' => 'Someone already adopt this dog!',
        'got_it' => 'You got it',
        'keep_update' => 'Keep Update!',
        'already_request' => 'You already request this dog.',
        'waiting_approval' => 'Waiting for approval from the owner',
    ],

    // create
    'form' => [
        'dog_type' => 'Dog Type',
        'color' => 'Color',
        'temperament' => 'Temperament',
        'gender' => 'Gender',
        'size' => 'Size',
        'description' => 'Description about the dog',
        'dog_picture' => 'Dog Picture',
        'preview' => 'Preview',
        'new_picture' => 'New Picture',
        'old_picture' => 'Old Picture',
        'vaccinated_date' => 'Last Vaccinated Date',
        'vaccination_certificate' => 'Vaccinated Proof',
        'sterilization_certificate' => 'Sterilization Proof',
        'district' => 'Area',
        'map_link' => 'Google Map Link',
        'option' => [
            'male' => 'Male',
            'female' => 'Female',
            'small' => 'Small <10kg',
            'medium' => 'Medium 11-15kg',
            'large' => 'Large 16-20kg',
            'extra' => 'Extra Large 20+kg',
        ],
        'button' => [
            'next' => 'Next',
            'submit' => 'Submit',
            'delete' => 'Delete',
        ],
        'placeholder' => [
            'dog_type' => 'Example : Local Dog',
            'color' => 'Example : Brawn, Black, White',
            'temperament' => 'Example : Aggressive, Calm, Energetic',
            'gender' => "Choose the dog's gender",
            'size' => "Choose the dog's size",
            'area' => "Choose the dog's area",
            'description' => 'Tell us about the dog health condition',
            'dog_picture' => 'Take pictures of the dog',
            'vaccination_certificate' => 'Please upload <span class="text-primary">the vaccination book, photo, or any other documentation </span>that can prove your dog has been vaccinated',
            'sterilization_certificate' => 'Please upload <span class="text-primary">the sterilization book/photo or any other documentation</span> proof that can demonstrate that your dog has been sterilized',
            'map_link' => "Please provide the link to the dog's location",
        ],
    ],

    'additional_contact' => [
        'alert' => [
            'title' => 'Pantau status anjing Anda',
            'content' => 'Anda dapat mempromosikan anjing Anda di berbagai platform media sosial,<br>dan kami sangat menyarankan untuk mengarahkan individu yang tertarik<br>untuk mengirimkan aplikasi adopsi melalui situs web kami untuk tujuan keamanan.'
        ],
        'no_adopter' => 'No adopter yet',
    ],
];
