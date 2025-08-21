$document_query = $conex->prepare("SELECT pay_doc, date FROM pay_docs WHERE store = ?");
        $document_query->bind_param("s", $prod_name);
        $document_query->execute();
        $result_docs = $document_query->get_result();

        echo "<article class='product' onclick=\"location.href='../bitscompare/bitscompare/store.php?store_name=" . htmlspecialchars(urlencode($prod_name)) . "'\">";
        echo "<div class='data-container'>";
        echo "<h1 class='numeration'>" . $counter . "</h1>";
        echo "<h1 class='prodname'>" . htmlspecialchars($prod_name) . "</h1>";
        echo "<h1 class='prod_desc'>" . htmlspecialchars($prod_description) . "</h1>";
        echo "<h1 class='prod_cat'>" . htmlspecialchars($prod_cat) . "</h1>";
        echo '<button onclick="event.stopPropagation();" class="xbutton show-details-button" name="xbutton">></button>';
        echo '<button onclick="event.stopPropagation(); openModal(' . $prod_id . ')" class="xbutton" name="xbutton">X</button>';
        echo "</div>";

        echo "<div class='details' style='display: none;'>";
            if ($result_docs && $result_docs->num_rows > 0) {
                while ($doc = $result_docs->fetch_assoc()) {
                    $document = $doc["pay_doc"];
                    $date = $doc["date"];
                    echo "<p>Fecha: " . htmlspecialchars($date) . "</p>";
                    echo "<iframe src='../Bitscompare/Bitscompare/" . htmlspecialchars($document) . "' width='100%' height='200'></iframe>";
                }
            } else {
             }
        echo "</div>";
        echo "</article>";

        $document_query->close();

        $counter++;
    }
}
?>