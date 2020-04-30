<form action="" method="POST">
<label>Enter Your Name Please:</label>
<input type="text"name=" name_entered" value='<?php echo $name; ?>'/>
<br><br>
<input type="submit" name="submitbutton" value="Submit"/>
</form>


<?php 

$name= $_POST['name_entered'];
$submitbutton= $_POST['submitbutton'];

if ($submitbutton){
if (!empty($name)) {
echo 'The name you entered is ' . $name;
}
else {
echo 'You did not enter a name. Please enter a name into this form field.';
}
?>
