<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = filter_var($_GET['country'], FILTER_SANITIZE_STRING);
$cities = filter_var($_GET['context'], FILTER_SANITIZE_STRING);

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE countries.name LIKE '%$country%';");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$second_query = $conn->query("SELECT DISTINCT cities.country_code, cities.district,
cities.population, cities.name as name_of_city, countries.name as name_of_country, countries.continent,countries.independence_year,countries.head_of_state FROM cities join countries on
cities.country_code = countries.code WHERE countries.name LIKE '%$country%';");

$city_results = $second_query->fetchAll(PDO::FETCH_ASSOC);

?>




<?php if(strlen($cities) > 0):?>
<table>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
  <?php foreach ($city_results as $row): ?>
    <tr>
        <td><?=$row['name_of_city']?></td>
        <td><?=$row['district']?></td>
        <td><?=$row['population']?></td>
      </tr>
  <?php endforeach; ?>
  </table>

<?php else: ?>
  <table>
    <tr>
      <th>Country's Name</th>
      <th>Continent</th>
      <th>Independence</th>
      <th>Head of State</th>
    </tr>

    <?php foreach ($results as $row): ?>
      <tr>
        <td><?=$row['name']?></td>
        <td><?=$row['continent']?></td>
        <td><?=$row['independence_year']?></td>
        <td><?=$row['head_of_state']?></td>
      </tr>
    <?php endforeach; ?>
</table>

<?php endif;?>
    