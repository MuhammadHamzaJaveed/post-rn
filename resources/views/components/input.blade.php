<div class="mt-1 flex justify-end">
    <div>
        <input
                autocomplete="off"
                {{ $attributes->merge(
                        [
                            'class' => "block w-64 border-2
                                        focus:bg-transparent focus:border-zinc-500 focus:ring-0 sm:text-sm
                                        placeholder-secondary-400",
                        ]
                    )
                }}
        >
    </div>
</div>
