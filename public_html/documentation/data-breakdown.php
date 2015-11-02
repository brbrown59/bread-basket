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
			<li>orgId (primary key)</li>
			<li>volId (foreign key)</li>
			<li>orgName</li>
			<li>orgAdminFirstName</li>
			<li>orgAdminLastName</li>
			<li>orgAdminTitle</li>
			<li>orgEmail</li>
			<li>orgHash</li>
			<li>orgSalt</li>
			<li>orgPhone</li>
			<li>orgType</li>
			<li>orgDescription</li>
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
			<li>Do we need an active field, so we can make volunteer inactive instead of deleting?</li>
			<li>What about a mute notification field? Would that be out of scope or easy to implement?</li>
		</ul>
		<p>Message/Notification</p>
		<p>Do we want to treat claim and pick up differently since the food bank claims the food and a volunteer picks up the food? Claim or a Claim and Pick up buttons for food bank???</p>
		<ul>
			<li>listingType</li>
			<li>listingMemo</li>
			<li>listingPickupTime</li>
			<li>listingPostTime</li>
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
			<li>parentListingId</li>
			<li>listingId (primary key)</li>
			<li>orgId (foreign key)</li>
			<li>listingType (what are the options here?)</li>
			<li>listingCost</li>
			<li>listingMemo (what are we expecting here?)</li>
			<li>listingPostTime</li>
			<li>orgName</li>
			<li>orgPhone</li>
			<li>orgAddress1</li>
			<li>orgAddress2</li>
			<li>orgCity</li>
			<li>orgState</li>
			<li>orgZip</li>
			<li>isClaimed</li>
			<li>wasPickedUp</li>
			<li></li>
		</ul>


	</body>
</html>