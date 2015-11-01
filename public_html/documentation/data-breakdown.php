<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Data Breakdown</title>
	</head>
	<body>
		<h1>Data Breakdown</h1>
		<p>Organization/Administrator</p>
		<ul>
			<li>orgID (primary key)</li>
			<li>orgName</li>
			<li>orgAdminFirstName</li>
			<li>orgAdminLastName</li>
			<li>orgAdminTitle</li>
			<li>orgEmail</li>
			<li>orgEmail validated?</li>
			<li>orgPassword</li>
			<li>orgPhone</li>
			<li>orgType</li>
			 <ul>
				 <li>Store or Food provider?</li>
				 <li>Restaurant</li>
				 <li>Food Bank or Pantry</li>
			 </ul>
			<li>orgDescription (what are we expecting here?)</li>
			<li>orgAddress1</li>
			<li>orgAddress2</li>
			<li>orgCity</li>
			<li>orgState</li>
			<li>orgZip</li>
			<li>orgHours</li>
		</ul>
		<p>Volunteer</p>
		<ul>
			<li>volId (primary key)</li>
			<li>volFirstName</li>
			<li>volLastName</li>
			<li>volEmail</li>
			<li>volPhone</li>
			<li>volActive</li>
			<li>volPushNotif</li>
			<li>orgId (foreign key)</li>
			<li>Do we need an opt in for push notifications?</li>
			<li>What about a mute notification field? Would that be out of scope or easy to implement?</li>
		</ul>
		<p>Message/Notification</p>
		<p>Do we want to treat claim and pick up differently since the food bank claims the food and a volunteer picks up the food? Claim or a Claim and Pick up buttons for food bank???</p>
		<ul>
			<li>listingType</li>
			<li>listingMemo</li>
			<li>listingPickupTime</li>
			<li>listingDateTime</li>
			<li>orgName</li>
			<li>orgEmail</li>
			<li>orgPhone</li>
			<li>orgAdminFirstName</li>
			<li>orgAdminLastName</li>
			<li>orgAddress1</li>
			<li>orgAddress2</li>
			<li>orgCity</li>
			<li>orgState</li>
			<li>orgZip</li>
			<li>orgHours</li>
			<li>messageId (primary key)</li>
			<li>listingId (foreign key)</li>
			<li>orgId (foreign key)</li>
		</ul>
		<p>Listing (robust) (recursive 1 to n)</p>
		<ul>
			<li>listingId (primary key)</li>
			<li>orgId (foreign key)</li>
			<li>listingType (what are the options here?)</li>
			<li>listingCost</li>
			<li>listingMemo (what are we expecting here?)</li>
			<li>listingDateTime</li>
			<li>listingPickupTime</li>
			<li>orgName</li>
			<li>orgPhone</li>
			<li>orgAddress1</li>
			<li>orgAddress2</li>
			<li>orgCity</li>
			<li>orgState</li>
			<li>orgZip</li>
			<li>isClaimed</li>
		</ul>

	</body>
</html>