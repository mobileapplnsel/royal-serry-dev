<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2021 <!--<a href="#">AdminLTE</a>.</strong> All rights
    reserved.-->
</footer>
<input id="baseUrl" type="hidden" value="<?= base_url() ?>" />

<!-- Subscription Delete Modal-->
<div class="modal fade" id="DocumentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Document?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="deleteDocument" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Video Tag Delete Modal-->
<div class="modal fade" id="videoTagDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Branch?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="deletevideotag" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- User Delete Modal-->
<div class="modal fade" id="UserDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the User?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="deleteuser" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Category Delete Modal-->
<div class="modal fade" id="categoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Category?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="deletecategory" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Package Category Delete Modal-->
<div class="modal fade" id="packagecategoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Category?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="deletepackagecategory" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PackageDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete this Package?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="deletePackage" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Video Delete Modal-->
<div class="modal fade" id="ProhibitedDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Prohibited?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="deleteProhibited" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Video Series Delete Modal-->
<div class="modal fade" id="PaymentoptionDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Payment Option?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="paymentoptseries" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Rate Delete Modal-->
<div class="modal fade" id="RateDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Rate?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="rateseries" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Tax Delete Modal-->
<div class="modal fade" id="TaxDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Tax Rate?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="taxdeletemodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Branch Area Delete Modal-->
<div class="modal fade" id="BranchAreaDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Branch Area?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="BranchAreamodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- User Area Delete Modal-->
<div class="modal fade" id="UserAreaDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the User Area?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="UserAreamodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Shift Delete Modal-->
<div class="modal fade" id="ShiftDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Shift?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="Shiftmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Shift Delete Modal-->
<div class="modal fade" id="UserShiftalloDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Shift Allocation?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="ShiftAllocationmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Banner Delete Modal-->
<div class="modal fade" id="BannerDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Banner Image?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="BannerImagemodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Banner Delete Modal-->
<div class="modal fade" id="BranchShiftalloDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Branch Shift?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="BranchShiftmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Banner Delete Modal-->
<div class="modal fade" id="ContainerDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Shipment?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="Shipmentmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Credit Delete Modal-->
<div class="modal fade" id="UserCreditDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Credit Amount?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="creditAmountmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Quote Delete Modal-->
<div class="modal fade" id="QuotationDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Quotation?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="Quotationmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Quote Delete Modal-->
<div class="modal fade" id="AddedItemDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Item From Container?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="addedItemmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Order status Delete Modal-->
<div class="modal fade" id="OrderStatusDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Order Status?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="OrderStatusmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Order status Delete Modal-->
<div class="modal fade" id="UserPickupOrderDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Order from this user?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="UserPickupOrdermodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Holiday Delete Modal-->
<div class="modal fade" id="BranchHolidayDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Holiday?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="BranchHolidaymodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Duty Delete Modal-->
<div class="modal fade" id="UserDutyalloDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Duty allocation?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="UserDutymodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- News Cat Delete Modal-->
<div class="modal fade" id="newscategoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the News Category?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="NewsCatDelmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- News Delete Modal-->
<div class="modal fade" id="NewsDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the News?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="NewsDelmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- News Delete Modal-->
<div class="modal fade" id="OrdercustomStatusDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Custom Status?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="CustomStatusDelmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Pickup Image Delete Modal-->
<div class="modal fade" id="pickupimgDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Image?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="PickupImgDelmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Delivery Image Delete Modal-->
<div class="modal fade" id="deliveryimgDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete the Image?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--<div class="modal-body">Select "Delete" below if you are ready to delete.</div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a id="DeliveryImgDelmodel" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>