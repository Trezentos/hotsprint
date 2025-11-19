<?php
class ImageUploadComponent {
    private $fieldName;
    private $fieldText;
    private $fieldValue;
    private $idPageParent;
    private $obs;
    private $width;
    private $pathFile = HTTP_UPLOADS_IMG;
    private $parParent;

    public function __construct($fieldName, $fieldText, $fieldValue, $idPageParent=null) {
        $this->fieldName    = $fieldName;
        $this->fieldText    = $fieldText;
        $this->fieldValue   = $fieldValue;
        $this->idPageParent = $idPageParent;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function setPathFile($pathFile) {
        $this->pathFile = $pathFile;
    }

    public function setWidthHtml($width) {
        $this->width = $width;
    }

    public function render() {
        global $id;

        echo '<h3 class="mt0"><i class="fa fa-picture-o"></i> ' . $this->fieldText . '</h3>';

        if( $this->fieldValue )
        {

            if( $this->idPageParent ) $this->parParent = '&id_pai='.$this->idPageParent;

            echo '<p><a data-lightbox="'.$this->fieldValue.'" href="'.$this->pathFile.$this->fieldValue.'"><img class="img-thumbnail" src="'.$this->pathFile.$this->fieldValue.'"  width="'.$this->width .'" /></a></p>
                <a class="btn btn-sm btn-danger" href="'.HTTP_GESTOR.'form/'.SELF_PAG.'?id='.$id.'&field='.$this->fieldName.'&'.$this->fieldName.'=1&del_img=1'.$this->parParent.'" title="Excluir"><span class="glyphicon glyphicon-trash"></span> Deletar imagem</a>';
        } else {

            echo '<input type="file" name="' . $this->fieldName . '">';
        } 
        
        echo '<p class="help-block">' . $this->obs . '</p>';
    }
}