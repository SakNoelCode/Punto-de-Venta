@props([
'labelText' => null,
'id',
'required' => false,
'defaultValue' => null,
'type' => null
])

<label for="{{$id}}" class="form-label">
    {{$labelText ?? ucfirst($id) }}:
    <span class="text-danger">{{ $required ? '*' : '' }}</span>
</label>
<input
    {{$required ? 'required' : ''}}
    type="{{ $type ? $type : 'text'}}"
    @if ($type == 'number')
        step="0.1"
    @endif
    name="{{$id}}"
    id="{{$id}}"
    class="form-control"
    value="{{old($id,$defaultValue)}}">
@error($id)
<small class="text-danger">{{'*'.$message}}</small>
@enderror