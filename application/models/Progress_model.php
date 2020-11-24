<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Progress_model extends MY_Model {

    public $table = 'progress';

    public function getDefaultValues()
    {
        return [
           
            'id'       => '',
            'motif'    => '',
            
           
            
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'motif',
                'label' => 'Motif',
                'rules' => 'trim|required'
            ],
        ];

        return $validationRules;
    }

}

/* End of file Progress_model.php */
