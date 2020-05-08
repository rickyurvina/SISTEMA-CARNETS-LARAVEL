<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $logo)}}">
    @csrf
    @method($txtMethod??'')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Logo')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="LOG_NOMBRE"
                required="required"
                class="form-control"
                value="{{old('LOG_NOMBRE', $logo->LOG_NOMBRE) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('LOG_NOMBRE','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Type')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="LOG_TIPO"
                required="required"
                class="form-control"
                value="{{old('LOG_TIPO',$logo->LOG_TIPO)}}">
            <span class="fa fa-book form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('LOG_TIPO','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Institution')}}
            <span class="required">*</span>
        </label>
            <select class="custom-select custom-select-sm col-md-6 col-sm-6"
                    name="institution_id" id="instituion_id" required>
                <option selected></option>
                @foreach($institution as $ins)
                    @if(old('institution', $logo->institution_id)==$ins->id)
                    <option value="{{$ins->id}}" selected>
                        {{$ins->INS_NOMBRE}}
                    </option>
                        @else
                        <option value="{{$ins->id}}">
                            {{$ins->INS_NOMBRE}}
                        </option>
                    @endif
                @endforeach
            </select>
        {!! $errors->first('institution_id','<small class="alert-error">:message</small>')!!}
    </div>
    <div class="ln_solid"></div>
    <div class="item form-group">
        <div class="col-md-6 col-sm-6 offset-md-3">
            <button
                type="submit"
                class="btn btn-success">
                <i class="fa fa-upload">
                </i>
                {{$btnText}}
            </button>
        </div>
    </div>
</form>
