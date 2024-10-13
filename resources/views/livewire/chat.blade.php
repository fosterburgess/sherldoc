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
{{--        <button wire:click='sendQuestion'>Submit</button>--}}
    </x-filament::input.wrapper>
    </form>

    <hr/>


    @if($conversation)
    @foreach($conversation as $result)
        <p class="clear-both mb-4 from{{$result['from']}}">
        {{$result['response']}}
        </p>
        <hr/>

    @endforeach
    @endif
    <Style>
        .fromagent {
            text-align:left;
            float:left;
        }
        .fromuser {
            text-align:right;
            float:right;
        }
    </Style>

</div>
