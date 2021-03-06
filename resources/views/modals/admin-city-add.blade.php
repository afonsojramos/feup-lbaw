    <div class="modal fade hide" id="cityModal" tabindex="-1" role="dialog" aria-labelledby="cityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cityModalLabel">New City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="newCityForm">
                <fieldset>
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control form-control-lg" name="name" placeholder="City official name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="country">Country <span class="text-danger">*</span></label>
                            <select id="country" class="custom-select" name="country_id" required>
                                <option selected>Select a country</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-12"></div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="save">Save it</label>
                            <input id="save" type="submit" class="btn btn-primary form-control" value="Save" />
                        </div>
                    </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>