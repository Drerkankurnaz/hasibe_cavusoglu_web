{{-- FAQ Accordion Item Component --}}
@props([
    'question' => '',
    'answer' => '',
    'index' => 0,
    'expanded' => false,
])

<h4 data-count="{{ $index + 1 }}" class="accordion-01__title {{ $expanded ? 'expanded_yes' : 'expanded_no' }}">
    {{ $question }}
</h4>
<div class="accordion-01__body">
    <div class="accordion-01__text">
        {!! $answer !!}
    </div>
</div>
