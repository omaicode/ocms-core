<x-forms::group :name="$name" :label="$label">
    <div class="d-flex align-items-center">
        <div class="thumbnail-preview">
            <img src="{{ $value ?: adminAsset('core/img/img-placeholder.png') }}" style="width: auto%; height: 100%; object-fit: contain">
        </div>
        <div class="ps-2 w-100">
            <input 
                type="file" 
                class="form-control form-control-thumbnail {{$errors->first($name) ? 'is-invalid' : ''}}" 
                name="{{$name}}" 
                placeholder="{{$placeholder}}"
                accept="image/jpg,image/jpeg,image/png,image/gif"
            >  
        </div>
    </div>
</x-forms::group>

@push('scripts')
<script>
    document.querySelector('.form-control-thumbnail[name="{{$name}}"]').addEventListener('change', function(el) {
        const file = el.target.files[0]
        const preview = el.target.parentNode.parentNode.querySelector('.thumbnail-preview img')

        if(!['image/jpg', 'image/jpeg', 'image/png', 'image/gif'].includes(file.type)) {
            el.target.value = null
            Notyf.error("{{__('validation.image', ['attribute' => $label])}}")
            return
        }
        
        if(preview) {
            preview.setAttribute('src', URL.createObjectURL(file))
        }

        console.log(file)
    });
</script>
@endpush