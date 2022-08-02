<?php

declare(strict_types=1);

require_once 'database.php';

class Hikes extends Database
{

    //To display all the hikes
    public function getHikes()
    {

        $db = $this->connectDb();

        $req = $db->query('SELECT * FROM hikes');

        $hikes = [];

        while (($row = $req->fetch())) {
            $hike = [
                'ID' => $row['ID'],
                'name' => $row['name'],
                'date' => $row['date'],
                'distance' => $row['distance'],
                'duration' => $row['duration'],
                'elevation_gain' => $row['elevation_gain'],
                'description' => $row['description'],
                'location' => $row['location'],
                'update' => $row['update'],
                'ID_tags' => $row['ID_tags'],
                'ID_user' => $row['ID_user'],
            ];

            $hikes[] = $hike;
        }

        return $hikes;
    }


    //To display one hikes by ID

    public function getHike(int $id)
    {

        $id;

        $id = $_GET["id"];

        $db = $this->connectDb();

        $req = $db->prepare('SELECT *
        FROM hikes
        WHERE id= :id');


        $req->bindValue(':id', $id);

        $req->execute();

        $hikesID = [];

        while (($row = $req->fetch())) {
            $hike = [
                'ID' => $row['ID'],
                'name' => $row['name'],
                'date' => $row['date'],
                'distance' => $row['distance'],
                'duration' => $row['duration'],
                'elevation_gain' => $row['elevation_gain'],
                'description' => $row['description'],
                'location' => $row['location'],
                'update' => $row['update'],
                'ID_tags' => $row['ID_tags'],
                'ID_user' => $row['ID_user'],
            ];

            $hikesID[] = $hike;
        }

        return $hikesID;
    }

    // to display hikes by tags 

    public function getHikeByTag(int $id)
    {

        $id;

        $id = $_GET["id"];

        $db = $this->connectDb();

        $req = $db->prepare('SELECT *
         FROM hikes
         WHERE ID_tags= :id');


        $req->bindValue(':id', $id);

        $req->execute();

        $hikesTag = [];

        while (($row = $req->fetch())) {
            $hike = [
                'ID' => $row['ID'],
                'name' => $row['name'],
                'date' => $row['date'],
                'distance' => $row['distance'],
                'duration' => $row['duration'],
                'elevation_gain' => $row['elevation_gain'],
                'description' => $row['description'],
                'location' => $row['location'],
                'update' => $row['update'],
                'ID_tags' => $row['ID_tags'],
                'ID_user' => $row['ID_user'],
            ];

            $hikesTag[] = $hike;
        }

        return $hikesTag;
    }

    // to display hikes by users 

    public function getHikeByUser(int $id)
    {
        $db = $this->connectDb();

        $req = $db->prepare('SELECT *
         FROM hikes
         WHERE ID_user= :id');


        $req->bindValue(':id', $id);

        $req->execute();

        $hikesUser = [];

        while (($row = $req->fetch())) {
            $hike = [
                'ID' => $row['ID'],
                'name' => $row['name'],
                'date' => $row['date'],
                'distance' => $row['distance'],
                'duration' => $row['duration'],
                'elevation_gain' => $row['elevation_gain'],
                'description' => $row['description'],
                'location' => $row['location'],
                'update' => $row['update'],
                'ID_tags' => $row['ID_tags'],
                'ID_user' => $row['ID_user'],
            ];

            $hikesUser[] = $hike;
        }

        return $hikesUser;
    }

    // insert hike

    public function addHike()
    {

        $db = $this->connectDb();
        $date = date("Y-m-d H:i:s");

        $req = $db->prepare('INSERT INTO hikes ( name, date, distance, duration, elevation_gain, description, location, ID_tags, ID_user) VALUES ( :name, :date, :distance, :duration, :elevation_gain, :description, :location, :ID_tags, :ID_user)');


        $req->bindValue(':name', $_POST['name']);
        $req->bindValue(':date', $date);
        $req->bindValue(':distance', $_POST['distance']);
        $req->bindValue(':duration', $_POST['duration']);
        $req->bindValue(':elevation_gain', $_POST['elevation_gain']);
        $req->bindValue(':description', $_POST['description']);
        $req->bindValue(':location', $_POST['location']);
        $req->bindValue(':ID_tags', $_POST['IDTags']);
        $req->bindValue(':ID_user', $_SESSION['LOGGED_USER']['ID']);

        $req->execute();
    }


    // insert hike

    public function removeHike()
    {

        $db = $this->connectDb();
        $id = $_POST['id_hike'];

        $req = $db->prepare('DELETE FROM hikes WHERE ID = '.$id);

        $req->execute();
    }


    //update hike

    public function updateHike()
    {

        $db = $this->connectDb();

        $req = $db->prepare('UPDATE hikes SET name = :name, distance = :distance, duration = :duration,
        elevation_gain = :elevation_gain, description = :description, location = :location, ID_tags = :IDTags WHERE hikes . ID = :id');
        
        $req->bindParam(':id', $_POST["ID"]);
        $req->bindParam(':name', $_POST['name']);
        $req->bindParam(':distance', $_POST['distance']);
        $req->bindParam(':duration', $_POST['duration']);
        $req->bindParam(':elevation_gain', $_POST['elevation_gain']);
        $req->bindParam(':description', $_POST['description']);
        $req->bindParam(':location', $_POST['location']);
        $req->bindParam(':IDTags', $_POST['IDTags']);
       

        $req->execute();
    }
}



$hikes = new Hikes();
