<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WysiwygTextarea extends Component
{
    private string $field;
    private ?string $value;
    private string $id;
    private string $textareaClass;
    private string $editorName;

    public function __construct(
        string $field,
        ?string $value,
        string $id,
        string $textareaClass,
        string $editorName
    )
    {
        $this->field = $field;
        $this->value = $value;
        $this->id = $id;
        $this->textareaClass = $textareaClass;
        $this->editorName = $editorName;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.wysiwyg-textarea',[
            'field' => $this->field,
            'value' => $this->value,
            'id' => $this->id,
            'textareaClass' => $this->textareaClass,
            'editorName' => $this->editorName,
        ]);
    }
}
