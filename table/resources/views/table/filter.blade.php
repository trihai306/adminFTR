<div class="modal fade " id="filter" wire:ignore tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold modal-title">Filter</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <form wire:submit.prevent="applyFilters">
                <div class="modal-body scroll-y ">
                    <!--begin::Form-->

                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">

                        <div class="mb-3">
                            @foreach($Input_filters as $filter)
                                <br>
                                {!! $filter->render() !!}
                            @endforeach
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->

                    <!--end::Actions-->

                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                        Discard
                    </button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                        <span class="indicator-label" wire:loading.class="hidden">Tìm kiếm</span>
                        <span class="indicator-progress" wire:loading>Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>

        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
