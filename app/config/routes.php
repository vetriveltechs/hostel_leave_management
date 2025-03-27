<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']                    = 'admin/adminLogin';
// $route['default_controller']                    = 'welcome/index';
$route['login.html']                            = 'admin/adminLogin';
$route['404_override']                          ='welcome/error';
$route['translate_uri_dashes']                  = FALSE;
$route['cms/(:any).html']                       = "welcome/cms/$1";
$route['home']                                  = 'welcome/home';
$route['home1']                                 = 'welcome/home1';
$route['product/(:any)']                        = 'welcome/product/$1';
$route['product-details/(:any)']                = 'welcome/productDetails/$1';
$route['about-us']                              = 'welcome/aboutUs';
$route['job-list.html']                         = 'welcome/joblist';
$route['blog-demo.html']                        = 'welcome/blogDemo';
$route['news']                                  = 'welcome/news';
$route['blog/(:any)']                           = 'welcome/blog/$1';
$route['whitepapers']                           = 'welcome/whitepapers';
$route['news-details.html/(:any)']              = 'welcome/newsDetails/$1';
$route['careers']                               = 'welcome/careers';
$route['careers-lists']                         = 'welcome/careersLists';
$route['careers-details']                       = 'welcome/careersDetails';
$route['events']                                = 'welcome/events';
$route['services-details/(:any)/(:any)']        = 'welcome/servicesdetails/$1/$2';
$route['services-detail/(:any)']                = 'welcome/servicesDetail/$1';

$route['blog-services/(:any)/(:any)']           = 'welcome/blogServices/$1/$2';
$route['blog-services-details/(:any)']           = 'welcome/blogServicesDetail/$1';

$route['industries-details/(:any)']             = 'welcome/industriesdetails/$1';
$route['events-details/(:any)']                 = 'welcome/eventsDetails/$1';
$route['success-stories']                       = 'welcome/successstories';
$route['success-stories-details']               = 'welcome/successstoriesdetails';
$route['thankyou']                              = 'welcome/thankYou';
$route['blog-details/(:any)/(:any)']            = 'welcome/blogDetails/$1/$2';
$route['job-lists']                             = 'welcome/jobLists';
$route['job-details']                           = 'welcome/jobDetails';
$route['industry']                              = 'welcome/industries';
$route['service/(:any)']                        = 'welcome/services/$1';
$route['seo.html']                              = 'welcome/seo';
$route['premium_suite.html']                    = 'welcome/premiumsuite';
$route['social-media-management-service.html']  = 'welcome/socialmediamanagementservice';
$route['standard.html']                         = 'welcome/standard';
$route['digital-marketing.html']                = 'welcome/digitalmarketing';
$route['mobile-app-developement.html']          = 'welcome/mobileAppDevelopement';
$route['website-developement.html']             = 'welcome/websitedevelopement';
$route['web-app-developement.html']             = 'welcome/webappdevelopement';
$route['google-ads.html']                       = 'welcome/googleads';
$route['web-design-services.html']              = 'welcome/webdesignservices';

$route['email-marketing-services.html']         = 'welcome/emailmarketingservices';
$route['products-demo.html']                    = 'welcome/productsDemo';
$route['success-story/(:any)']                   = 'welcome/successStory/$1';
$route['success-story-details/(:any)/(:any)']    = 'welcome/successStoryDetails/$1/$2';
$route['location']                              = 'welcome/location';
$route['contact-us']                            = 'welcome/contact';
$route['terms-and-conditions.html']             = 'welcome/terms_conditions';
$route['cookie-policy.html']                    = 'welcome/cookiePolicy';
$route['whitepapers-details/(:any)']            = 'welcome/whitePaperDetails/$1';
$route['subscribes']                            = 'welcome/subscribes';
$route['privacy-policy']                        = 'welcome/privacyPolicy';
$route['terms-and-conditions']                  = 'welcome/termsAndConditions';
$route['refund-policy']                         = 'welcome/refundPolicy';
$route['cancellation-policy']                   = 'welcome/cancellationPolicy';















