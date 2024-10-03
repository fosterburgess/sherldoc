<div>
    <h3>Chat</h3>
    <hr/>

    <form wire:submit="sendQuestion">
    <x-filament::input.wrapper>
        <x-filament::input
                type="text"
                wire:model="question"
                placeholder="Ask me a question..."
        />
    </x-filament::input.wrapper>
    </form>

    <hr/>

    You asked {{$question}}
    <hr/>
    @if($results)
    @foreach($results as $result)
        <pre>{{$result}}</pre>
        <hr/>

    @endforeach
    @endif
</div>
