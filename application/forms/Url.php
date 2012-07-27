<?php
/**
 * Description of Url
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Form_Url extends \Zend_Form
{
    public function init()
    {
        $this->setOptions(array(
            'elements' => array(
                'title' => array('text', array(
                    'label'      => 'Url Title',
                    'placeholder' => 'Maksimum 128 karakter.',
                    'required'   => true,
                    'validators' => array(
                        array('stringLength', false, array('min' => 10, 'max' => 128))
                    )
                )),
                'url' => array('text', array(
                    'label'      => 'Url',
                    'placeholder' => 'Maksimum 254 karakter.',
                    'required'   => true,
                    'validators' => array(
                        array('stringLength', false, array('min' => 10, 'max' => 254)),
                        array('Db_NoRecordExists', false, array('url', 'url'))
                    )
                )),
                'tags' => array('text', array(
                    'label' => 'Tags',
                    'placeholder' => 'Pisahkan dengan koma.',
                    'required'   => true,
                )),
                'note' => array('textarea', array(
                    'label' => 'Note',
                    'placeholder' => 'Opsional. 1024 karakter.',
                    'attribs' => array(
                        'rows' => 3,
                    ),
                    'filters' => array(
                        'stripTags'
                    ),
                    'validators' => array(
                        array('stringLength', false, array('min' => 20, 'max' => 1024))
                    )
                )),
                'submit' => array('submit', array(
                    'label' => 'Save'
                ))
            )
        ));
    }
}
