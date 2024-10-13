<?php

namespace App\Livewire;

use App\Actions\AskWithPromptInfo;
use App\Actions\QueryDocuments;
use App\Events\MessageEvent;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{
    public string $question;
    public array $conversation = [];
    public ?Collection $results;

    protected $listeners = [MessageEvent::class=>'listenForMessage'];

    public function sendQuestion()
    {
        MessageEvent::dispatch($this->question);
        $action = app(QueryDocuments::class);
        $results = $action($this->question);
        $this->conversation[] = ['from'=>'user','response'=>$this->question];
        $topResult = $results[0];
        $ask = app(AskWithPromptInfo::class)($this->question, $topResult['content']);
        $this->conversation[] = ['from'=>'agent','response'=>$ask];
//        foreach($results as $result) {
//            $this->conversation[] = ['from'=>'agent','response'=>$this->formatChunk($result)];
//        }



        $this->question = '';
    }

    #[On('messages')]
    public function listenForMessage($data){
        $this->conversation[] = $data['theMessage'];
    }


    public function render()
    {
        return view('livewire.chat');
    }

    public function formatChunk($chunk)
    {
        $string = '';
        $string = Str::words($chunk['content'], 20);
        return $string;
    }
}
