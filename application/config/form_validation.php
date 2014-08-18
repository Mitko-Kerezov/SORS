<?php

$config = array(
    'signup' => array(
        array(
            'field' => 'fname',
            'label' => 'Име',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'mname',
            'label' => 'Презиме',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'lname',
            'label' => 'Фамилия',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'tel',
            'label' => 'Телефон',
            'rules' => 'required|max_length[15]|numeric'
        ),
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|max_length[40]|valid_email|callback_unique_email'
        ),
        array(
            'field' => 'class',
            'label' => 'Клас',
            'rules' => 'required|greater_than[1]|less_than[13]|integer'
        ),
        array(
            'field' => 'city',
            'label' => 'Град',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'school',
            'label' => 'Училище',
            'rules' => 'required|max_length[100]|callback_is_cyrillic'
        ),
        array(
            'field' => 'teacher',
            'label' => 'Ръководител',
            'rules' => 'required|max_length[100]|callback_is_cyrillic'
        ),
        array(
            'field' => 'project',
            'label' => 'Тема на проект',
            'rules' => 'required|max_length[100]'
        ),
        array(
            'field' => 'category',
            'label' => 'Направление',
            'rules' => 'required|callback_category_check'
        ),
        array(
            'field' => 'coop',
            'label' => 'Съавторство',
            'rules' => 'required|callback_coop_check'
        ),
		array(
			'field' => 'st_reg_comp',
			'label' => 'Състезание',
			'rules' => 'required'
		)
    ),
	'signup_regular' => array(
        array(
            'field' => 'fname',
            'label' => 'Име',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'mname',
            'label' => 'Презиме',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'lname',
            'label' => 'Фамилия',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'tel',
            'label' => 'Телефон',
            'rules' => 'max_length[15]|numeric'
        ),
        array(
          'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|max_length[40]|valid_email|callback_unique_email'
        ),
        array(
            'field' => 'class',
            'label' => 'Клас',
            'rules' => 'required|greater_than[1]|less_than[13]|integer'
        ),
        array(
            'field' => 'city',
            'label' => 'Град',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'school',
            'label' => 'Училище',
            'rules' => 'required|max_length[100]|callback_is_cyrillic'
        ),
		array(
			'field' => 'st_reg_comp',
			'label' => 'Състезание',
			'rules' => 'required'
		)
    ),
	
    'admin' => array(
        array(
            'field' => 'uname',
            'label' => 'Потребителско име',
            'rules' => 'required|max_length[20]'
        ),
        array(
            'field' => 'pass',
            'label' => 'Парола',
            'rules' => 'required|max_length[20]'
        )
    ),
    'new_comp' => array(
        array(
            'field' => 'name',
            'label' => 'Име на състезанието',
            'rules' => 'required'
        ),
        array(
            'field' => 'place',
            'label' => 'Място на провеждане',
            'rules' => 'required'
        ),
        array(
            'filed' => 'date',
            'label' => 'Дата на провеждане',
            'rules' => 'required'
        ),
        array(
            'filed' => 'deadline',
            'label' => 'Краен срок за регистрация',
            'rules' => 'required'
        ),
        array(
            'filed' => 'info',
            'label' => 'Допълнителна информация',
            'rules' => ''
        )
    ),
	'single' => array(
        array(
            'field' => 'single[fname]',
            'label' => 'Име',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'single[mname]',
            'label' => 'Презиме',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'single[lname]',
            'label' => 'Фамилия',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'single[email]',
            'label' => 'E-mail',
            'rules' => 'required|max_length[40]|valid_email|callback_unique_email'
        ),
        array(
            'field' => 'single[class]',
            'label' => 'Клас',
            'rules' => 'required|greater_than[1]|less_than[13]|integer'
        ),
        array(
            'field' => 'single[teacher]',
            'label' => 'Ръководител',
            'rules' => 'required|max_length[100]|callback_is_cyrillic'
        ),
        array(
            'field' => 'single[project]',
            'label' => 'Тема на проект',
            'rules' => 'required|max_length[100]'
        ),
        array(
            'field' => 'single[category]',
            'label' => 'Направление',
            'rules' => 'required|callback_category_check'
        ),
        array(
            'field' => 'single[coop]',
            'label' => 'Съавторство',
            'rules' => 'required|less_than[2]|integer'
        )
    ),
	'single_regular' => array(
        array(
            'field' => 'single[fname]',
            'label' => 'Име',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'single[mname]',
            'label' => 'Презиме',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'single[lname]',
            'label' => 'Фамилия',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'single[email]',
            'label' => 'E-mail',
            'rules' => 'required|max_length[40]|valid_email|callback_unique_email'
        ),
        array(
            'field' => 'single[class]',
            'label' => 'Клас',
            'rules' => 'required|greater_than[1]|less_than[13]|integer'
        )
    ),
	'single_mass' => array(
		array(
            'field' => 'group_city',
            'label' => 'Град',
            'rules' => 'required|max_length[20]|callback_is_cyrillic'
        ),
        array(
            'field' => 'group_school',
            'label' => 'Училище',
            'rules' => 'required|max_length[100]|callback_is_cyrillic'
        )
	)
);


