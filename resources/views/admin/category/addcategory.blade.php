<div class="col-12 grid-margin">
    <form class="forms-sample" id="categoryForm">
       @csrf
        <input type="hidden" name="id" id="id" value="">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description<span class="required">*</span></label>
                    <textarea class="form-control" id="description" name="description" id="description" rows="4"></textarea>
                </div>
            </div>

        </div>
        <br>
        <br>
        <button type="submit" onclick="addCategory(event)" class="btn btn-gradient-primary mr-2" id="categoryButton">Add
            Service</button>
    </form>
</div>
