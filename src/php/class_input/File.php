<?php
namespace FormCustom\class_input;

class File extends Input
{
    CONST DEFAUT_PREVIEW = ['img' => '/images/empty_img.png', 'video' => '/images/empty_video.png', 'img_cropper' => '/images/empty_img.png'];

    public function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->setParam($options);
    }

    public function setParam($options) {
        $this->params = array_merge($this->params, [
            'source' => $this->definePreview($options),
            'accept' => $options['accept'] ?? $this->dataType ,
            'preview' => $options['preview'] ?? '',
            'position' => isset($options['position']) ? ' ' . $options['position'] : '',
        ]);
    }

    public function definePreview($params) {
        if(!isset($params['preview']) || $params['preview'] == "") {
            return self::DEFAUT_PREVIEW[$this->dataType];
        }

        if(is_numeric($params['preview'])) {
            return '' . $params['preview'];
        }

        return $params['preview'];
    }
}
