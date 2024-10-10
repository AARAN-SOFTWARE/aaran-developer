<section
    x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
    :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))"
    role="tabpanel"
    class="sm:p-8 p-4 space-y-2"
>
    {{$slot}}
</section>
