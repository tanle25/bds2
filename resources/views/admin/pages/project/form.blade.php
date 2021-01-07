<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Thông tin Bất động sản</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Tên dự án</label>
                    <input
                    id="name"
                    type="text"
                    class="form-control  @error('name') is-invalid @enderror"
                    name="name"
                    placeholder="Tên dự án"
                    value="{{$project->name ?? old('name')}}"
                    >
                    @error('name')
                    <div id="" class="error invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label for="">Slug</label>
                    <input
                    id="slug"
                    type="text"
                    class="form-control  @error('slug') is-invalid @enderror"
                    name="slug"
                    placeholder="Slug"
                    value="{{$project->slug ?? old('slug')}}"
                    >
                    @error('slug')
                    <div id="" class="error invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>



            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="site_area">Diện tích tổng thể(<span class="text-red">*</span>)</label>
                    <input
                    name="site_area"
                    type="number"
                    class="form-control @error('site_area') is-invalid @enderror"
                    id="site_area"
                    placeholder="Nhập diện tích tổng thể"
                    value="{{$project->site_area ?? old('site_area')}}"
                    >
                    @error('site_area')
                    <div id="" class="error invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="construction_area">Diện tích xây dựng (<span class="text-red">*</span>)</label>
                    <input
                    name="construction_area"
                    type="number"
                    class="form-control @error('construction_area') is-invalid @enderror"
                    id="construction_area"
                    placeholder="Nhập diện tích BDS"
                    value="{{$project->construction_area ?? old('construction_area')}}"
                    >
                    @error('construction_area')
                    <div id="" class="error invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>

            </div>

            <div class="form-group">
                <label for="investor">Chủ dự án(<span class="text-red">*</span>)</label>
                <input
                name="investor"
                type="text"
                class="form-control @error('investor') is-invalid @enderror"
                id="investor"
                placeholder="Chủ dự án"
                value="{{$project->investor ?? old('investor')}}"
                >
                @error('investor')
                <div id="" class="error invalid-feedback d-block">
                        {{$message}}
                </div>
                @enderror
            </div>

            @include('admin.pages.project.location_picker')

            <div class="row">
                <div class="map-container mx-auto col-12" style="padding:20px">
                    <div id="map" style="width: 100%; height:500px"></div>
                </div>
                <input type="hidden" name="google_map_lat">
                <input type="hidden" name="google_map_lng">
            </div>

            <div class="form-group ">
                <label class="control-label">Mô tả địa điểm</label>
                @include('admin.components.ckeditor', ['id' => 'location_description',
                'name' => 'location_description',
                'current_input' => $project->location_description ?? old('location_description') ?? ''
                ])
                @error('location_description')
                <div id="" class="error invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mô tả dự án</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            <div class="form-group ">
                <label class="control-label">Chính sách ưu đãi</label>
                @include('admin.components.ckeditor', ['id' => 'promotion_term',
                'name' => 'promotion_term',
                'current_input' => $project->promotion_term ?? old('promotion_term') ?? ''
                ])
                @error('promotion_term')
                <div id="" class="error invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group ">
                <label class="control-label">Mô tả chi tiết dự án</label>
                @include('admin.components.ckeditor', ['id' => 'description',
                'name' => 'description',
                'current_input' => $project->description ?? old('description') ?? ''
                ])
                @error('description')
                <div id="" class="error invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quản lý ảnh dự án</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group ">
                <label class="control-label">Ảnh slider chính</label>
                @include('admin.components.button_file_manager', ['id' => 'overview_image',
                    'input_name' => 'overview_image',
                    'current_input' => $project->overview_image ?? ''
                ])
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mặt bằng dự án</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('admin.pages.project.ground_editor')
        </div>
    </div>

</div>
<div class="col-md-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Thao tác</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="btn-set">
                <button type="submit" name="submit" value="save" class="btn btn-info">
                    <i class="fa fa-save"></i> Lưu
                </button>
                &nbsp;
                <button type="submit" name="submit" value="apply" class="btn btn-success">
                    <i class="fa fa-check-circle"></i> Lưu &amp; Thoát
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Trạng thái </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label>Trạng thái</label>
                <select class="form-control select2 select2-info" value="" name="status" data-dropdown-css-class="select2-info"
                    style="width: 100%;">
                    @foreach (config('constant.project_status') as $index =>  $item)
                    <option value="{{$index}}" @if (isset($project) && $project->status == $index) selected @endif >{{$item['name'] ?? ''}}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Loại dự án</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Loại dự án</label>
                <select class="form-control select2 select2-info" name="project_type" data-dropdown-css-class="select2-info"
                    style="width: 100%;">
                    @foreach (config('constant.project_type') as $index => $item)
                    <option value="{{$index}}" @if (isset($project) && $project->project_type == $index) selected @endif >{{$item['name']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="">Ngày khởi công</label>
                <input
                id="date-picker"
                @isset($project)
                value="{{Carbon\Carbon::parse( $project->start_time)->format('d/m/Y') ?? Carbon\Carbon::now()->format('d/m/Y')}}"
                @endisset
                class="date-picker form-control"
                type="text"
                name="start_time"
                >
                @error('start_time')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="">Ngày hoạt động/ dự kiến</label>
                <input
                id="date-picker"
                @isset($project)
                value="{{Carbon\Carbon::parse( $project->launch_time)->format('d/m/Y') ?? Carbon\Carbon::now()->format('d/m/Y')}}"
                @endisset
                class="date-picker form-control"
                type="text"
                name="launch_time"
                >
                @error('launch_time')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ảnh đại diện</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group ">
                <label class="control-label">Ảnh đại diện</label>
                @include('admin.components.button_file_manager', ['id' => 'avatar',
                    'input_name' => 'avatar',
                    'current_input' => $project->avatar ?? ''
                ])
            </div>
            <div class="form-group ">
                <label class="control-label">Ảnh sơ đồ tổng thể</label>
                @include('admin.components.button_file_manager', ['id' => 'overall_diagram',
                    'input_name' => 'overall_diagram',
                    'current_input' => $project->overall_diagram ?? ''
                ])
            </div>
        </div>
    </div>
</div>

@section('css')
    @parent
    <link rel="stylesheet" href="{{asset('template/dropzone-5.7.0/dist/dropzone.css')}}">
@endsection

@section('script')
@parent
    <script src="{{asset('template/dropzone-5.7.0/dist/dropzone.js')}}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $('#name').on('blur', function () {
            getSlug('project', $(this).val(), $('#slug'));
        });

    </script>
@endsection
