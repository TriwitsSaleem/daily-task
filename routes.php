<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Customer_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['set-language']              = $route['default_controller'].'/cookieforLanguage';
$route['customer-reg'] = $route['default_controller'].'/customerRegistration';
$route['customer-home'] = $route['default_controller'].'/homePage';
$route['varieties-list/(:any)'] = $route['default_controller'].'/varietyList/$1';
$route['customer-login'] = $route['default_controller'].'/loginCustomer';
$route['customer-logout'] = $route['default_controller'].'/customerLogout';
$route['login-customer'] = $route['default_controller'].'/loginVerify';
$route['shop'] = $route['default_controller'].'/shop';
$route['register-customer'] = $route['default_controller'].'/registerCustomer';
$route['saplings-list/(:any)/(:any)'] = $route['default_controller'].'/saplingListByVarietyId/$1/$2';
$route['insert-sapling-shop/(:any)'] = $route['default_controller'].'/insertSaplingShop/$1';
$route['chech-adhaar'] =  $route['default_controller'].'/check_adhaar_avalibility';
$route['chech-servey'] =  $route['default_controller'].'/check_servay_avalibility';
$route['get-cost'] =  $route['default_controller'].'/getCost';
$route['view-cart/(:any)/(:any)'] =  $route['default_controller'].'/viewCart/$1/$2';
$route['confirm-order/(:any)/(:any)'] =  $route['default_controller'].'/confirmOrder/$1/$2';
$route['add-to-cart'] =  $route['default_controller'].'/addToCart';
$route['cart'] =  $route['default_controller'].'/getCartDetails';
$route['update-cart-qty'] =  $route['default_controller'].'/updateCartQuantity';
$route['confirm-customer-order'] =  $route['default_controller'].'/confirmCustomerOrder';
$route['my-orders'] =  $route['default_controller'].'/getMyOrders';
$route['ordered-saplings/(:any)'] =  $route['default_controller'].'/getOrderedSaplingsByOrderId/$1';
$route['customer-login'] = $route['default_controller'].'/login';
$route['upload-images'] = $route['default_controller'].'/uploads';
$route['insert-uploads'] = $route['default_controller'].'/insertImages';
$route['view-images/(:any)'] = $route['default_controller'].'/viewImages/$1';
$route['future-demand'] = $route['default_controller'].'/futureDemand';
$route['insert-future-demand'] = $route['default_controller'].'/futureDemandAdded';
$route['view-future-demand'] = $route['default_controller'].'/viewFutureDemand';
$route['edit-future-demand'] = $route['default_controller'].'/updateFutureDemandAdded';
$route['delete-future-demand'] = $route['default_controller'].'/deleteFutureDemandAdded';
$route['update-sapling-future-demand/(:any)'] = $route['default_controller'].'/updateSaplingFutureDemand/$1';
$route['view-future-sapling/(:any)'] = $route['default_controller'].'/viewFutureSapling/$1';
$route['delete-sapling-future-demand/(:any)'] = $route['default_controller'].'/deleteSaplingFutureDemand/$1';
$route['beneficiaries'] = $route['default_controller'].'/beneficiaries';
$route['beneficiaries-saplings/(:any)'] = $route['default_controller'].'/viewBeneficiariesSapling/$1';
$route['benefit'] = $route['default_controller'].'/benefits';
$route['insert-benefit'] = $route['default_controller'].'/uploadBenefit';
$route['view-comments/(:any)'] = $route['default_controller'].'/viewComments/$1';
$route['checkout'] = $route['default_controller'].'/checkoutPage';

$route['admin_controller'] = 'Admin_controller';
$route['admin-dashboard'] = $route['admin_controller'].'/adminDashboard';
$route['varieties'] = $route['admin_controller'].'/varieties';
$route['varieties-type'] = $route['admin_controller'].'/varietiesTypes';
$route['insertvarieties'] = $route['admin_controller'].'/insertVarities';
$route['editvarieties'] = $route['admin_controller'].'/editVarities';
$route['deletevarieties'] = $route['admin_controller'].'/deleteVarities';
$route['insert-variety-type'] = $route['admin_controller'].'/insertVaritiesTypes';
$route['add-saplings'] = $route['admin_controller'].'/addSaplings';
$route['insert-saplings'] = $route['admin_controller'].'/insertSapling';
$route['view-saplings'] = $route['admin_controller'].'/viewSaplings';
$route['edit-saplings'] = $route['admin_controller'].'/editSapling';
$route['delete-saplings'] = $route['admin_controller'].'/deleteSapling';
$route['nursery'] = $route['admin_controller'].'/nursery';
$route['insert-nursery'] = $route['admin_controller'].'/addNursery';
$route['view-nursery'] = $route['admin_controller'].'/viewNursery';
$route['edit-nursery'] = $route['admin_controller'].'/editNursery';
$route['delete-nursery'] = $route['admin_controller'].'/deleteNursery';
$route['nursery-officer/(:any)'] = $route['admin_controller'].'/viewNurseryOfficer/$1';
$route['edit-officer/(:any)'] = $route['admin_controller'].'/editOfficer/$1';
$route['delete-officer/(:any)'] = $route['admin_controller'].'/deleteOfficer/$1';
$route['stock-add'] = $route['admin_controller'].'/addStock';
$route['insert-stock'] = $route['admin_controller'].'/insertStock';
$route['view-stock'] = $route['admin_controller'].'/viewStock';
$route['view-stock-saplings/(:any)'] = $route['admin_controller'].'/viewStockSaplings/$1';
$route['view-orders'] = $route['admin_controller'].'/orders';
$route['view-orders-details/(:any)'] = $route['admin_controller'].'/ordersDetails/$1';
$route['admin-individual-sapling'] = $route['admin_controller'].'/individualSapling';
$route['nursery-individual-sapling'] = $route['admin_controller'].'/nurseryIndividualSapling';
$route['login'] = $route['admin_controller'].'/adminLogin';
$route['verify-login'] = $route['admin_controller'].'/loginVerify';
$route['admin-logout'] = $route['admin_controller'].'/admin_logout';
$route['change-password'] = $route['admin_controller'].'/changePsw';
$route['all-orders'] = $route['admin_controller'].'/allOrders';
$route['sapling-details/(:any)'] = $route['admin_controller'].'/viewSaplingsDetails/$1';
$route['edit-sapling-details/(:any)'] = $route['admin_controller'].'/editSaplingDetails/$1';
$route['get-saplings-list'] =  $route['admin_controller'].'/exportSaplingsForStock';
$route['upload-sapling'] =  $route['admin_controller'].'/uploadFile';
$route['upload-stock'] =  $route['admin_controller'].'/uploadStock';
$route['new-bags'] = $route['admin_controller'].'/insertBasDetails';
$route['overall-stock'] = $route['admin_controller'].'/viewallStock';
$route['sapling-edit/(:any)'] = $route['admin_controller'].'/editSaplings/$1';
$route['bag-sizes'] = $route['admin_controller'].'/bagSize';
$route['inser-bag-sizes'] = $route['admin_controller'].'/insertBagsize';
$route['edit-bag-sizes'] = $route['admin_controller'].'/editBagsize';
$route['delete-bag-sizes'] = $route['admin_controller'].'/deleteBagsize';
$route['opening-stock'] = $route['admin_controller'].'/openingStock';
$route['current-stock'] = $route['admin_controller'].'/currentStock';
$route['sold-sapling'] = $route['admin_controller'].'/saledSaplings';
$route['all-pending-oreders'] = $route['admin_controller'].'/pendingAllOrders';
$route['all-delivered-oreders'] = $route['admin_controller'].'/deliveredAllOrders';
$route['reservation-stock'] = $route['admin_controller'].'/reservationStock';
$route['insert-reservation'] = $route['admin_controller'].'/insertReservation';
$route['sold-reservation'] = $route['admin_controller'].'/soldReservation';
$route['back-reservation'] = $route['admin_controller'].'/backReservation';
$route['order-reschedule'] = $route['admin_controller'].'/orderRescheduled';
$route['receive-orders'] = $route['admin_controller'].'/receivedOrders';
$route['reschedule-orders'] = $route['admin_controller'].'/rescheduleOrders';
$route['received-order-reschedule'] = $route['admin_controller'].'/orderRescheduleReceived';
$route['orders-received'] = $route['admin_controller'].'/orderReceived';
$route['revenue-generated'] = $route['admin_controller'].'/revenueGenerated';
$route['accounts'] = $route['admin_controller'].'/accounts';
$route['add-payment'] = $route['admin_controller'].'/addPayment';
$route['view-payments/(:any)'] = $route['admin_controller'].'/payment/$1';
$route['update-payments'] = $route['admin_controller'].'/editPayment';
$route['delete-payments'] = $route['admin_controller'].'/deletePayment';
$route['all-payments'] = $route['admin_controller'].'/allPayment';
$route['vehicle'] = $route['admin_controller'].'/vehicle';
$route['insert-vehicle'] = $route['admin_controller'].'/insertVehicle';
$route['update-vehicle'] = $route['admin_controller'].'/updateVehicle';
$route['delete-vehicle'] = $route['admin_controller'].'/deleteVehicle';
$route['saplings'] = $route['admin_controller'].'/saplingsHome';
$route['nursery-page'] = $route['admin_controller'].'/nurseryHome';
$route['stocks'] = $route['admin_controller'].'/stockHome';
$route['orders-page'] = $route['admin_controller'].'/orderHome';
$route['local-sales'] = $route['admin_controller'].'/localSaleHome';
$route['cash-remittance'] = $route['admin_controller'].'/cashRemittance';
$route['insert-cash-remittance'] = $route['admin_controller'].'/insertcashRemittance';
$route['update-cash-remittance'] = $route['admin_controller'].'/updatecashRemittance';
$route['delete-remittance'] = $route['admin_controller'].'/deletecashRemittance';
$route['monthly-statement'] = $route['admin_controller'].'/monthlyStatement';
$route['cash-monthly-report'] = $route['admin_controller'].'/cashReport';
$route['sapling-monthly-report'] = $route['admin_controller'].'/saplingReport';
$route['income-monthly-report'] = $route['admin_controller'].'/incomecashReport';
$route['view-beneficiaries'] = $route['admin_controller'].'/beneficiaries';
$route['uploads-comments'] = $route['admin_controller'].'/uploadsComments';
$route['customer-upload'] = $route['admin_controller'].'/customerUpload';
$route['view-uploaded-images/(:any)'] = $route['admin_controller'].'/viewImages/$1';
$route['nursery-upload'] = $route['admin_controller'].'/nurseryUpload';
$route['after-planting-upload'] = $route['admin_controller'].'/afterPlanting';
$route['yield-benifit-upload'] = $route['admin_controller'].'/yieldBenifit';
$route['view-losses'] = $route['admin_controller'].'/viewLoss';
$route['view-loss-details/(:any)'] = $route['admin_controller'].'/viewLossDetails/$1';
$route['seedling-reserve'] = $route['admin_controller'].'/seedlingReserve';
$route['insert-seedling-reserve'] = $route['admin_controller'].'/insertSeadlingReserve';
$route['view-seedling-reserve'] = $route['admin_controller'].'/viewSeedlingReserve';
$route['edit-seedling-reserve'] = $route['admin_controller'].'/editSeadlingReserve';
$route['delete-seedling-reserve'] = $route['admin_controller'].'/deleteSeadlingReserve';
$route['certificate/(:any)'] = $route['admin_controller'].'/certificate/$1';
$route['view-reserve-sapling/(:any)'] = $route['admin_controller'].'/reserveSaplings/$1';
$route['edit-reserve-sapling/(:any)'] = $route['admin_controller'].'/editReserveSapling/$1';
$route['delete-reserve-sapling/(:any)'] = $route['admin_controller'].'/deleteReserveSapling/$1';
$route['comments/(:any)'] = $route['admin_controller'].'/comments/$1';
$route['customer-details/(:any)'] = $route['admin_controller'].'/customerDetails/$1';
$route['customer-invoice/(:any)'] = $route['admin_controller'].'/invoice/$1';
$route['registered-customer'] = $route['admin_controller'].'/registerCustomer';
$route['more-details/(:any)'] = $route['admin_controller'].'/displayMap/$1';

$route['nursery_controller'] = 'Nursery_controller';
$route['nursery-home'] = $route['nursery_controller'].'/nurseryHome';
$route['stock-status'] = $route['nursery_controller'].'/stockStatus';
$route['order-list'] = $route['nursery_controller'].'/orderList';
$route['order-details/(:any)'] = $route['nursery_controller'].'/orderDetails/$1';
$route['accept-reject-orders'] = $route['nursery_controller'].'/acceptRejectOrders';
$route['payment-collected'] = $route['nursery_controller'].'/payment';
$route['individual-saplings'] = $route['nursery_controller'].'/individualSapling';
$route['enter-new-stock'] = $route['nursery_controller'].'/enterNewStock';
$route['nusrery-login'] = $route['nursery_controller'].'/nurseryLogin';
$route['verify-nusrery-login'] = $route['nursery_controller'].'/nurseryLoginVerify';
$route['nursery-change-password'] = $route['nursery_controller'].'/nurseryChangePsw';
$route['nusrery-logout'] = $route['nursery_controller'].'/nursery_logout';
$route['reject-order'] = $route['nursery_controller'].'/rejectOrder';
$route['received-order'] = $route['nursery_controller'].'/receivedOrder';
$route['individual-sapling-insert'] = $route['nursery_controller'].'/insertIndividualSap';
$route['edit-individual-sapling'] = $route['nursery_controller'].'/editIndividualSap';
$route['delete-individual-sapling'] = $route['nursery_controller'].'/deleteIndividualSap';
$route['add-new-stock'] = $route['nursery_controller'].'/addNewStock';
$route['order-accept'] = $route['nursery_controller'].'/updateSlot';
$route['nursery-opening-stock'] = $route['nursery_controller'].'/openingStock';
$route['nursery-current-stock'] = $route['nursery_controller'].'/currentStock';
$route['nursery-sold-sapling'] = $route['nursery_controller'].'/soldSaplings';
$route['pending-orders'] = $route['nursery_controller'].'/pendingOrders';
$route['delivered-orders'] = $route['nursery_controller'].'/deliveredOrders';
$route['insert-reschedule-orders'] = $route['nursery_controller'].'/reschedule';
$route['nursery-reschedule-orders'] = $route['nursery_controller'].'/rescheduleOrders';
$route['nursery-reschedule-received'] = $route['nursery_controller'].'/rescheduleRecieved';
$route['uploads-page'] = $route['nursery_controller'].'/uploadHome';
$route['uploads-images-on-delivered'] = $route['nursery_controller'].'/uploadImages';
$route['insert-uploads-images-on-delivered'] = $route['nursery_controller'].'/uploadDeliveredImages';
$route['view-uploads-images/(:any)'] = $route['nursery_controller'].'/viewNurseryImages/$1';
$route['view-uploads-images-after-planting'] = $route['nursery_controller'].'/viewAfterPlantImages';
$route['view-uploads-images-by-customer'] = $route['nursery_controller'].'/viewOnDeliveryByCustomerImages';
$route['losses'] = $route['nursery_controller'].'/lossesHome';
$route['add-loss'] = $route['nursery_controller'].'/addLoss';
$route['insert-loss'] = $route['nursery_controller'].'/insertLoss';
$route['view-loss'] = $route['nursery_controller'].'/viewLoss';
$route['update-loss'] = $route['nursery_controller'].'/updateLoss';
$route['delete-loss'] = $route['nursery_controller'].'/deleteLoss';
$route['nursery-comments/(:any)'] = $route['nursery_controller'].'/comments/$1';
$route['view-nursery-payments/(:any)'] = $route['nursery_controller'].'/nurseryPayment/$1';
$route['nursery-cash-remittance'] = $route['nursery_controller'].'/nurseryCashRemittance';
$route['insert-nursery-cash-remittance'] = $route['nursery_controller'].'/insertNurseryCashRemittance';
$route['update-nursery-cash-remittance'] = $route['nursery_controller'].'/updateNurseryCashRemittance';
$route['delete-nursery-remittance'] = $route['nursery_controller'].'/deleteNurseryCashRemittance';
$route['nursery-monthly-statement'] = $route['nursery_controller'].'/nurseryMonthlyRepost';
$route['nursery-cash-monthly-statement'] = $route['nursery_controller'].'/cashNurseryReport';
$route['nursery-sapling-monthly-report'] = $route['nursery_controller'].'/monthlySapling';

$route['local_sales_controller'] = 'Local_sales';
$route['add-local-sales'] = $route['local_sales_controller'].'/addLocalSales';
$route['insert-local-sales'] = $route['local_sales_controller'].'/insertLocalSales';
$route['view-local-sales'] = $route['local_sales_controller'].'/viewLocalSales';
$route['view-saplings-local-sales/(:any)'] = $route['local_sales_controller'].'/viewSaplingsLocalSales/$1';
$route['update-saplings-local-sales/(:any)'] = $route['local_sales_controller'].'/updateLocalSalesSaplings/$1';
$route['delete-saplings-local-sales/(:any)'] = $route['local_sales_controller'].'/deeteLocalSalesSaplings/$1';
$route['update-local-sales'] = $route['local_sales_controller'].'/edit_local_sales';


