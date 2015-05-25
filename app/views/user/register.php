<div class="row">
    <div class="col-md-12">
        <form action="<?php generate_url('register')?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" name="name" class="form-control" id="name"/>
            </div>
            <div class="form-group">
                <label for="email"> Email</label>
                <input type="email" name="email" class="form-control" id="email"/>
            </div>
            <div class="form-group">
                <label for="mobile"> Mobile</label>
                <input type="text" name="mobile" class="form-control" id="mobile"/>
            </div>
            <div class="form-group">
                <label for="password"> Password</label>
                <input type="password" name="password" class="form-control" id="password"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success btn-lg" value="Register" "/>
            </div>
        </form>
    </div>
</div>
