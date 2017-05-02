<?php



class M_Tree extends M_Html
{

    private $idColumnName;
    private $parentIdColumnName;
    private $contentColumnsNames;
    private $inputArray;
    private $rootElement;
    private $structure;

    /**
     * @param array $columns
     */
    
    public function __construct($inpArray, $rootElem = 0)
    {
        $this->inputArray = $inpArray;
        $this->rootElement = $rootElem;
    }

    public function setColumnsNames ($columns)
    {
        $this->idColumnName = $columns [0];
        $this->parentIdColumnName = $columns [1];
        $this->contentColumnsNames = $columns [2];
    }

    public function getTreeStructure () 
    {

        function cstructure ($records, $rootElementId = 0){
        $returnArray = array();
        foreach ($records as $item){
            if ($item['parent_id'] == $rootElementId){
                $children = cstructure ($records, $item['id']);
                if (!!$children){
                    $returnArray[] = [
                        'id' => $item ['id'],
                        'parent_id' => $rootElementId,
                        'content' => $item ['content'],
                        'children' => $children
                    ];
                }else{
                    $returnArray[] = [
                        'id' => $item ['id'],
                        'parent_id' => $rootElementId,
                        'content' => $item ['content'],
                    ];
                }
            }
        }
        return $returnArray;
        }
        $this->structure = cstructure($this->inputArray, $this->rootElement);
    }

    private function composeList ()
    {
        function clist ($str){
        $returnString = '';
        foreach ($str as $item){
            if (isset($item['children'])){
                $innerTag = M_Html::makeTag([
                    'tagname' => 'ul', 
                    'inner_html' => clist($item['children']),
                    'attributes' => [
                        'class' => $item['id']
                    ]
                ]);
                $returnString .=  M_Html::makeTag([
                    'tagname' => 'li', 
                    'inner_html' => $item['content'].$innerTag, 
                    'attributes' => [
                        'class' => $item['id']
                    ]
                ]);
            }else{
                $returnString .= M_Html::makeTag([
                    'tagname' => 'li', 
                    'inner_html' => (isset ($item['content'])) ?  $item['content'] : '', 
                    'attributes' => [
                        'class' => $item['id']
                    ]
                ]);
            }
        }
        return $returnString;
        }
        return clist($this->structure);
    }

    public function formList()
    {
        return $this->makeTag([
            'tagname' => 'ul', 
            'inner_html' => $this->composeList(),
            'attributes' => [
                'class' => 'list'
            ]
        ]);
    }
}
