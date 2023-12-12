<?php
// PHP code to display available Relationship Among Cultivars from the database

// Check if $current_relationship_among_cultivars_id is not null
if ($current_relationship_among_cultivars_id !== null) {
    // Query to select all available Relationship Among Cultivars in the database
    $query7 = "SELECT * FROM relationship_among_cultivars WHERE relationship_among_cultivars_id='$current_relationship_among_cultivars_id'";

    // Executing query
    $query_run7 = pg_query($connection, $query7);

    // If count is greater than 0, we have Relationship Among Cultivars; else, we do not have Relationship Among Cultivars
    if (pg_num_rows($query_run7) > 0) {
        $relationship_among_cultivars = pg_fetch_assoc($query_run7);

        // Distinct Groups of Cultivars based on Morphological and Genetic Characteristics
        $distinct_groups = isset($relationship_among_cultivars['distinct_cultivar_groups_morph_gen']) ? $relationship_among_cultivars['distinct_cultivar_groups_morph_gen'] : "No Distinct Groups Available";

        // Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis
        $relations_cluster_pca = isset($relationship_among_cultivars['cultivar_relations_cluster_and_pca']) ? $relationship_among_cultivars['cultivar_relations_cluster_and_pca'] : "No Relationships Available";

        // Potential for Hybridization and Breeding Among Cultivars
        $hybridization_potential = isset($relationship_among_cultivars['hybridization_potential']) ? $relationship_among_cultivars['hybridization_potential'] : "No Hybridization Potential Available";

        // Implications for Conservation and Breeding Efforts
        $conservation_breeding_implications = isset($relationship_among_cultivars['conservation_and_breeding_implications']) ? $relationship_among_cultivars['conservation_and_breeding_implications'] : "No Implications Available";
?>
        <tr>
            <th class="table-secondary w-25" scope="row">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
            <td><textarea name="distinct_cultivar_groups_morph_gen" class="w-100 border-0 p-1" rows="5" disabled><?= $distinct_groups; ?></textarea></td>
        </tr>
        <tr>
            <th class="table-secondary">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
            <td><textarea name="cultivar_relations_cluster_and_pca" class="w-100 border-0 p-1" rows="5" disabled><?= $relations_cluster_pca; ?></textarea></td>
        </tr>
        <tr>
            <th class="table-secondary">Potential for Hybridization and Breeding Among Cultivars</th>
            <td><textarea name="hybridization_potential" class="w-100 border-0 p-1" rows="5" disabled><?= $hybridization_potential; ?></textarea></td>
        </tr>
        <tr>
            <th class="table-secondary">Implications for Conservation and Breeding Efforts</th>
            <td><textarea name="conservation_and_breeding_implications" class="w-100 border-0 p-1" rows="5" disabled><?= $conservation_breeding_implications; ?></textarea></td>
        </tr>
<?php
    }
} else {
    // Handle the case when $current_relationship_among_cultivars_id is null
    ?>
    <tr>
        <th class="table-secondary w-25" scope="row">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
        <td><textarea name="distinct_cultivar_groups_morph_gen" class="w-100 border-0 p-1" rows="5" disabled>No Distinct Groups of Cultivars based on Morphological and Genetic Characteristics Available</textarea></td>
    </tr>
    <tr>
        <th class="table-secondary">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
        <td><textarea name="cultivar_relations_cluster_and_pca" class="w-100 border-0 p-1" rows="5" disabled>No Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis Available</textarea></td>
    </tr>
    <tr>
        <th class="table-secondary">Potential for Hybridization and Breeding Among Cultivars</th>
        <td><textarea name="hybridization_potential" class="w-100 border-0 p-1" rows="5" disabled>No Potential for Hybridization and Breeding Among Cultivars Available</textarea></td>
    </tr>
    <tr>
        <th class="table-secondary">Implications for Conservation and Breeding Efforts</th>
        <td><textarea name="conservation_and_breeding_implications" class="w-100 border-0 p-1" rows="5" disabled>No Implications for Conservation and Breeding Efforts Available</textarea></td>
    </tr>
<?php
}
?>
