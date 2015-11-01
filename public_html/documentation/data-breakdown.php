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
			<li>orgID</li>
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
			<li>volunteerId</li>
			<li>volunteerName</li>
			<li>volunteerEmail</li>
			<li>volunteerPhone</li>
			<li>orgId</li>
			<li>Do we need an opt in for push notifications?</li>
			<li>Do we need an active field, so we can make volunteer inactive instead of deleting?</li>
			<li>What about a mute notification field? Would that be out of scope or easy to implement?</li>
		</ul>
		<p>Message/Notification</p>
		<p>Do we want to treat claim and pick up differently since the food bank claims the food and a volunteer picks up the food? Claim or a Claim and Pick up buttons for food bank???</p>
		<ul>
			<li>listingType</li>
			<li>listingMemo</li>
			<li>listingPickupTime</li>
			<li>orgName</li>
			<li>orgEmail</li>
			<li>orgPhone</li>
			<li>orgAdminName</li>
			<li>orgAddress1</li>
			<li>orgAddress2</li>
			<li>orgCity</li>
			<li>orgState</li>
			<li>orgZip</li>
			<li>orgHours</li>
			<li>messageId</li>
			<li>listingId</li>
			<li>orgId</li>
		</ul>
		<p>Listing (robust) (recursive 1 to n)</p>
		<ul>
			<li>listingId</li>
			<li>orgId</li>
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
			<li></li>
		</ul>



	</body>
</html>