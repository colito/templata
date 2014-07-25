[page:Chosen]

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".chosen").data("placeholder","Select Frameworks...").chosen();
    });
</script>

<!-- single dropdown -->
<select class="chosen" style="width:200px;">
    <option>Choose...</option>
    <option>jQuery</option>
    <option selected="selected">MooTools</option>
    <option>Prototype</option>
    <option>Dojo Toolkit</option>
</select>


<!-- multiple dropdown -->
<!--
<select class="chosen" multiple="true" style="width:400px;">
    <option>Choose...</option>
    <option>jQuery</option>
    <option selected="selected">MooTools</option>
    <option>Prototype</option>
    <option selected="selected">Dojo Toolkit</option>
</select>


<script>
    jQuery(document).ready(function(){
        jQuery(".chosen").data("placeholder","Select Frameworks...").chosen();
    });
</script>
-->