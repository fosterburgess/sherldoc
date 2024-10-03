<?php

namespace App\Livewire;

use App\Actions\QueryDocuments;
use Illuminate\Support\Collection;
use Livewire\Component;

class Chat extends Component
{
    public string $question;
    public ?Collection $results;

    public function sendQuestion()
    {
        $action = app(QueryDocuments::class);
        $this->results = $action($this->question);
        $this->question = '';
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
