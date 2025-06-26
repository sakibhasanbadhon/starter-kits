  <div id="store_or_update_modal" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" ></h5>
                <button type="button" class="close shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form id="store_or_update_form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="update_id" id="update_id">
                    <x-forms.inputbox name="name" labelName="Name" required="required"/>
                    <x-forms.selectbox name="status" labelName="Status" required="required">
                        <option value="">-- Select Option --</option>
                        @foreach (STATUS as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-form.selectbox>
                </form>
            </div>
            <div class="modal-footer pt-0 border-0">
                <button type="button" class="btn btn-sm btn-danger rounded-0" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary rounded-0" id="save-btn"></button>
            </div>
        </div>
    </div>
</div>
