Services_Scalarium
==================

This is a PHP Wrapper for the Scalarium API. So far, it retrieves different types of data but doesn't perform any actions.
It is open source software, licensed with the New BSD License.

## Configuration

To use this wrapper, you need to know the endpoint URL, the access header, and the secret token for Scalarium:

    $endpoint = 'https://manage.scalarium.com/api/';
    $accept = 'application/vnd.scalarium-v1+json';
    $token = '_secret_data_';

## Applications

The Application class can be used to retrieve all applications:

    $applications = new Applications($endpoint, $accept, $token);
    $applicationsData = $applications->getApplications();
    var_dump($applicationsData);

It can also be used to retrieve all deployments of one application:

    $applications = new Applications($endpoint, $accept, $token);
    $applicationsDeploymentByApplication = $applications->getDeploymentsByApplication('_app_id_');
    var_dump($applicationsDeploymentByApplication);

## Clouds

The Clouds class can be used to retrieve all clouds:

    $clouds = new Clouds($endpoint, $accept, $token);
    $cloudsData = $clouds->getClouds();
    var_dump($cloudsData);

It can also be used to retrieve all applications in one cloud:

    $clouds = new Clouds($endpoint, $accept, $token);
    $cloudsApplicationInCloud = $clouds->getApplicationsInCloud('_cloud_id_');
    var_dump($cloudsApplicationInCloud);

## Deployments

The Deployments class is used to retrieve all deployments of applications (not clouds):

    $deployments = new Deployments($endpoint, $accept, $token);
    $deploymentsData = $deployments->getDeployments();
    var_dump($deploymentsData);

Note that this is a potentially expensive operation that may call the API many times, so you might want to
implement a cache if you want to retrieve the data from this method repeatedly.
