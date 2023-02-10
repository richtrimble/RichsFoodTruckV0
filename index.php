<?php
// foodTruckV1.php
// IT262 Winter 2023 P3 Food Truck
// Added more menu options and increased max quantity to 9 - Richard Trimble

// HTML Form

echo '<form action="" method="POST">
	<p>What kind of waffle would you like? $5.95</p>
	<fieldset>
		<legend>Waffle Type:</legend>
		<p><input type="radio" name="WaffleType" value="Belgium" />Belgium</p>
		<p><input type="radio" name="WaffleType" value="American" />American</p>
		<p><input type="radio" name="WaffleType" value="Hong Kong" />Hong Kong</p>
		<p><input type="radio" name="WaffleType" value="Liege" />Liege</p>
		<p><input type="radio" name="WaffleType" value="Stroopwafel" />Stroopwafel</p>
	</fieldset>			
	
	<fieldset>
		<legend>Your favorite toppings: $0.99 each</legend>
		<p><input type="checkbox" name="FavoriteToppings[]" value="Warm Chocolate" />Warm Chocolate</p>
		<p><input type="checkbox" name="FavoriteToppings[]" value="Homemade Caramel" />Homemade Caramel</p>
		<p><input type="checkbox" name="FavoriteToppings[]" value="Nutella" />Nutella</p>
		<p><input type="checkbox" name="FavoriteToppings[]" value="Peanut Butter" />Peanut Butter</p>
		<p><input type="checkbox" name="FavoriteToppings[]" value="Fresh Strawberries" />Fresh Strawberries</p>
		<p><input type="checkbox" name="FavoriteToppings[]" value="Fresh Blueberries" />Fresh Blueberries</p>
		<p><input type="checkbox" name="FavoriteToppings[]" value="Whipped Cream" />Whipped Cream</p>
		<p><input type="checkbox" name="FavoriteToppings[]" value="Vanilla Ice Cream" />Vanilla Ice Cream</p>
	</fieldset>			

	<fieldset>
		<label for="wqty">How many of these would you like?</label>
		<select id="wqty" name="WaffleQty">
		  <option value="0">0</option>
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		  <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
		</select>	
	</fieldset>			
	
	<fieldset>
		<legend>Would you like a salad?</legend>
		<p><input type="radio" name="Salad" value="Garden Fresh" />Garden Fresh $3.95</p>
		<p><input type="radio" name="Salad" value="Chicken Caesar" />Chicken Caesar $5.95</p>
		<p><input type="radio" name="Salad" value="Chef" />Chef $5.95</p>
	</fieldset>			
	
	<fieldset>
		<label for="sqty">How many of these would you like?</label>
		<select id="sqty" name="SalQty">
		  <option value="0">0</option>
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		  <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
		</select>	
	</fieldset>			
	
	<fieldset>
		<legend>Something to drink? $2.95</legend>
		<p><input type="radio" name="Beverage" value="Colombian Brewed Coffee" />Colombian Brewed Coffee</p>
		<p><input type="radio" name="Beverage" value="Our Special Punch" />Our Special Punch</p>
		<p><input type="radio" name="Beverage" value="Bottled Spring Water" />Bottled Spring Water</p>
	</fieldset>			
	
	<fieldset>
		<label for="bqty">How many of these would you like?</label>
		<select id="bqty" name="BevQty">
		  <option value="0">0</option>
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		  <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
		</select>	
	</fieldset>			
	
	<p><input type="submit" /></p>		
</form>';

// Load input items into class Item and display order total

$itemNumber = 1;
$subtotal = 0;

echo '<p>Your order is:</p>';

// Waffle type selection

if(isset($_POST['WaffleType'])) {
	$myItem = new Item($itemNumber,$_POST['WaffleType'],$_POST['WaffleType'],5.95);
	$items[] = $myItem;
	$itemNumber++;
	$subtotal = 5.95;
	echo '<p>'.$_POST['WaffleType'].' Waffle $5.95</p>';
}

// Topping selection

if(isset($_POST['FavoriteToppings'])) {
	if(isset($_POST['WaffleType'])) {  // Only accept topping selections if waffle type is selected
	   foreach($_POST['FavoriteToppings'] as $value){
	      echo '<p>- with '.$value.' topping $0.95</p>';
			$myItem->addExtra($value);
			$subtotal = $subtotal + 0.95;
		}
   } else {
		echo 'To get toppings, you have to select a waffle to put them on!';
	}
}
echo '<p>Cost for one waffle is: $'.sprintf("%.2f", $subtotal).'</p>';
if($_POST['WaffleQty'] > 1) { // Note if more than one is ordered
	$subtotal = $subtotal * $_POST['WaffleQty'];
	echo '<p>'.$_POST['WaffleQty'].' Waffles ordered at $'.sprintf("%.2f", $subtotal).'</p>';
}

if(isset($_POST['WaffleType'])) {
	echo '----------------------------------------'; // LIKELY DELETE AFTER CSS ADDED
}

// Salad selection

if(isset($_POST['Salad'])) {
	if($_POST['Salad'] == "Garden Fresh") {
		$myItem = new Item(2,$_POST['Salad'],$_POST['Salad'],3.95); // Only Garden Fresh is priced differently at $3.95
		$saladPrice = 3.95;
	} else {
		$myItem = new Item(2,$_POST['Salad'],$_POST['Salad'],5.95); // Both remaining options are priced the same at $5.95
		$saladPrice = 5.95;
	}
	$items[] = $myItem;
	echo '<p>Salad: '.$_POST['Salad'].' at '.sprintf("%.2f", $saladPrice).' each</p>';
}

$saladSubtotal = $saladPrice * $_POST['SalQty'];
if($_POST['SalQty'] > 1) { // Note if more than one is ordered
	echo '<p>'.$_POST['SalQty'].' salads ordered at $'.sprintf("%.2f", $saladSubtotal).'</p>';
}
$subtotal = $subtotal + $saladSubtotal;

if(isset($_POST['Salad'])) {
	echo '----------------------------------------'; // LIKELY DELETE AFTER CSS ADDED
}

// Beverage selection

if(isset($_POST['Beverage'])) {
	$myItem = new Item(3,$_POST['Beverage'],$_POST['Beverage'],2.95);
	$items[] = $myItem;
	echo '<p>Beverage: '.$_POST['Beverage'].' at $2.95 each</p>';
}

$bevSubtotal = 2.95 * $_POST['BevQty'];
if($_POST['BevQty'] > 1) { // Note if more than one is ordered
	echo '<p>'.$_POST['BevQty'].' beverages ordered at $'.sprintf("%.2f", $bevSubtotal).'</p>';
}
$subtotal = $subtotal + $bevSubtotal;

if(isset($_POST['Beverage'])) {
	echo '----------------------------------------'; // LIKELY DELETE AFTER CSS ADDED
}

echo '<p>Your subtotal is: $'.sprintf("%.2f", $subtotal).'</p>';

$tax = $subtotal * 0.1025;
echo '<p>Tax at 10.25% is: $'.sprintf("%.2f", $tax).'</p>';
$total = $subtotal + $tax;
echo '<p>Your total is: $'.sprintf("%.2f", $total).'</p>';

// FOR DEV INFO ONLY - DELETE IN FINAL vvvvvvvvvvvvvvv

echo '<p>var dump for code dev info follows:</p>'; 
echo '<pre>';
var_dump($items);
echo '</pre>';

// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

class Item
{
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array();
    
    public function __construct($ID,$Name,$Description,$Price)
    {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;
        
    }#end Item constructor
    
    public function addExtra($extra)
    {
        $this->Extras[] = $extra;
        
    }#end addExtra()

}#end Item class
