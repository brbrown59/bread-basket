<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Data Breakdown</title>
	</head>
	<body>
		<h1>Data Breakdown</h1>

		<p>Organization</p>
		<ul>
			<li>orgId (primary key)</li>
			<li>orgName</li>
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
		<p>Admin</p>
		<ul>
			<li>adminId (primary key)</li>
			<li>volId (foreign key)</li>
			<li>orgId (foreign key)</li>
			<li>adminFirstName</li>
			<li>adminLastName</li>
			<li>adminEmail</li>
			<li>adminEmailActivation</li>
			<li>adminPhone</li>
			<li>adminHash</li>
			<li>adminSalt</li>
		</ul>

		<p>Volunteer</p>
		<ul>
			<li>volId (primary key)</li>
			<li>orgId (foreign key)</li>
			<li>volFirstName</li>
			<li>volLastName</li>
			<li>volEmail</li>
			<li>volEmailActivation</li>
			<li>volPhone</li>
		</ul>
		<p>Message/Notification</p>
		<ul>
			<li>messageId (primary key)</li>
			<li>listingId (foreign key)</li>
			<li>orgId (foreign key)</li>
			<li>listingType</li>
			<li>listingMemo</li>
			<li>listingPickupTime</li>
			<li>listingPostTime</li>
			<li>orgName</li>
			<li>orgPhone</li>
			<li>orgAddress1</li>
			<li>orgAddress2</li>
			<li>orgCity</li>
			<li>orgState</li>
			<li>orgZip</li>
		</ul>
		<p>Listing (robust) (recursive 1 to n)</p>
		<ul>
			<li>parentListingId</li>
			<li>listingId (primary key)</li>
			<li>orgId (foreign key)</li>
			<li>listingType</li>
			<li>listingCost</li>
			<li>listingMemo</li>
			<li>listingPostTime</li>
			<li>orgName</li>
			<li>orgPhone</li>
			<li>orgAddress1</li>
			<li>orgAddress2</li>
			<li>orgCity</li>
			<li>orgState</li>
			<li>orgZip</li>
			<li>claimedBy</li>
			<li>wasPickedUp</li>
			<li></li>
		</ul>


	</body>
</html>