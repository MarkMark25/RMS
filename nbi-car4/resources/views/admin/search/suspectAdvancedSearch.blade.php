<div class="form-group">
    <p><strong>NOTE:</strong> This search engine shows all the possible information in relevance in every field of this search bar.You can use the <strong>TABLE FILTERS</strong> after you click Search to get the desired information you want.</p>
    <br>
    <div class="form-row">
        <div class="col-md-3">
            <input type="text" class="form-control" name="suspectName" placeholder="Suspect Name">
            <br>
            <input type="text" class="form-control" name="hairColor" placeholder="Hair Color" onkeypress="validateColor(event)" minlength="1" maxlenght="70">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="height" placeholder="Height" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlenght="10">
            <br>
            <input type="text" class="form-control" name="eyeColor" placeholder="Eye Color" onkeypress="validateColor(event)" minlength="1" maxlenght="70">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="weight" placeholder="Weight" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlenght="10">
            <br>
            <input type="text" class="form-control" name="skinTone" placeholder="Skin Tone" onkeypress="validateColor(event)" minlength="1" maxlenght="70">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="age" placeholder="Age" onkeypress="validateAge(event)" minlength="1" maxlenght="10">
            <br>
            {{--
            <select name="sex" id="" class="form-control">
                <option value="" style="font-style:italic;">Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            --}}
        </div>
    </div>
</div>
<div class="">

</div>
