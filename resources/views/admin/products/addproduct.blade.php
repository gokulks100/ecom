<div class="col-12 grid-margin">
    <form class="forms-sample" id="productForm">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id" value="">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> Product Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category">Category<span class="required">*</span></label>
                    {{-- <input type="text" class="form-control" id="category" name="category"
                        placeholder="Category"> --}}

                        <select name="category" class="form-control" id="category">
                            <option disabled selected>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{  $category->id }}">{{  $category->name  }}</option>
                            @endforeach

                        </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Price<span class="required">*</span></label>
                    <input type="text" class="form-control numberValidation" id="price" placeholder="Price" name="price">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="stock">Stock<span class="required">*</span></label>
                    <input type="text" class="form-control numberValidation" id="stock" placeholder="Stock" name="stock">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Description<span class="required">*</span></label>
                    <textarea class="form-control" id="description" name="description" id="description" rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Images <span>*</span></label>
                    <div class="multiImage">
                        <div class="upload__box">
                            <div class="upload__img-wrap" id="imageDiv">
                            </div>
                        </div>
                    </div>
                    <div class="input-group hdtuto control-group lst increment mutiPhotoInput" >
                        <input type="file" name="images[]" id="image" class="myfrm form-control" accept="image/*" data-name="Image">
                        <div class="input-group-btn">
                            <button class="btn btn-success" id="addImage" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                        </div>
                    </div>
                    <div class="clone hide">
                        <div class="hdtuto control-group lst input-group mutiPhotoInput addImage" style="margin-top:10px">
                            <input type="file" name="images[]" class="myfrm form-control" accept="image/*">
                            <div class="input-group-btn">
                                <button class="btn btn-danger" type="button" id="removeImage"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <button type="submit" onclick="addProduct(event)" class="btn btn-gradient-primary mr-2" id="productButton">Add
            Service</button>
    </form>
</div>
