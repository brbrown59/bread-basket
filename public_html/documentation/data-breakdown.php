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
			<li>orgAdminName</li>
			<li>orgType</li>
			<li>orgDescription</li>
			<li>orgLocation</li>
			<li>orgHours</li>
			<li>orgEmail</li>
		</ul>
		<p>Volunteer</p>
		<ul>
			<li>volunteer Id</li>
			<li>volunteer name</li>
			<li>volunteer email</li>
			<li>volunteer phone</li>
			<li>organization Id</li>
			<li></li>
		</ul>
		<p>Message/Notification</p>
		<ul>
			<li>listing type</li>
			<li>listing memo</li>
			<li>listing pickup time</li>
			<li>organization name</li>
			<li>orgAdmin name</li>
			<li>organization location</li>
			<li>organization phone</li>
		</ul>
		<p>Listing (robust) (recursive 1 to n)</p>
		<ul>
			<li>listingId</li>
			<li>listing type</li>
			<li>listing cost</li>
			<li>listing memo</li>
			<li>listing date time</li>
			<li>listing pickup time</li>
			<li>organization name</li>
			<li>organization phone</li>
			<li>org location</li>
			<li></li>
		</ul>


		<p>Reporting</p>
	</body>
</html>