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
			<li>orgAddress1</li>
			<li>orgAddress2</li>
			<li>orgCity</li>
			<li>orgDescription</li>
			<li>orgHours</li>
			<li>orgName</li>
			<li>orgPhone</li>
			<li>orgState</li>
			<li>orgType</li>
			<li>orgZip</li>
		</ul>
		<p>Admin</p>
		<ul>
			<li>adminId (primary key)</li>
			<li>orgId (foreign key)</li>
			<li>volId (foreign key)</li>
			<li>adminEmail</li>
			<li>adminEmailActivation</li>
			<li>adminFirstName</li>
			<li>adminHash</li>
			<li>adminLastName</li>
			<li>adminPhone</li>
			<li>adminSalt</li>
		</ul>

		<p>Volunteer</p>
		<ul>
			<li>volId (primary key)</li>
			<li>orgId (foreign key)</li>
			<li>volEmail</li>
			<li>volEmailActivation</li>
			<li>volFirstName</li>
			<li>volLastName</li>
			<li>volPhone</li>
		</ul>
		<p>Message/Notification</p>
		<ul>
			<li>messageId (primary key)</li>
			<li>listingId (foreign key)</li>
			<li>orgId (foreign key)</li>
			<li>messageText</li>
		</ul>
		<p>Listing (recursive 1 to n)</p>
		<ul>
			<li>listingId (primary key)</li>
			<li>orgId (foreign key)</li>
			<li>listingClaimedBy</li>
			<li>listingClosed</li>
			<li>listingCost</li>
			<li>listingMemo</li>
			<li>listingParentId</li>
			<li>listingPostTime</li>
			<li>listingType</li>
		</ul>


	</body>
</html>