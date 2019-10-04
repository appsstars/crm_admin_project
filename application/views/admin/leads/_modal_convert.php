<div class="panel panel-custom">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= lang('convert_to_client') ?></h4>
    </div>
    <div class="modal-body wrap-modal wrap">
        <form id="form_validation"
              action="<?php echo base_url() ?>admin/leads/converted/<?php if (!empty($leads_info->leads_id)) echo $leads_info->leads_id; ?>"
              method="post" class="form-horizontal form-groups-bordered">
            <form role="form" enctype="multipart/form-data" id="form"
                  action="<?php echo base_url(); ?>admin/client/save_client/<?php
                  if (!empty($client_info)) {
                      echo $client_info->client_id;
                  }
                  ?>" method="post" class="form-horizontal  ">
                <div class="panel-body">
                    <div class="row bg-box">

                        <div class="col-md-6 col-sm-12 col-xs-12 ">
                            <div class="form-group">
                                <label class="control-label col-sm-6"><?= lang('select_type') ?></label>
                                <div class="col-lg-6">
                                    <select class="form-control" name="client_status" id="client_stusus">
                                        <option value="1" <?php
                                        if (!empty($client_info) && $client_info->client_status == 1) {
                                            echo 'selected';
                                        }
                                        ?>>Person
                                        </option>
                                        <option value="2" <?php
                                        if (!empty($client_info) && $client_info->client_status == 2) {
                                            echo 'selected';
                                        }
                                        ?>>Company
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <label class="control-label col-sm-3"></label

                    <div class="col-sm-6">
                        <!--- /************ Person Start ***************/ --->
                        <div class="person" style="<?php
                        if (!empty($person)) {
                            echo 'display:block';
                        } else {
                            echo 'display:none';
                        }
                        ?>">
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#general"
                                                          data-toggle="tab"><?= lang('general') ?></a></li>
                                    <li><a href="#contact" data-toggle="tab"><?= lang('client_contact') ?></a>
                                    </li>
                                    <li><a href="#web" data-toggle="tab"><?= lang('web') ?></a></li>
                                    <li><a href="#hosting" data-toggle="tab"><?= lang('hosting') ?></a></li>
                                </ul>
                                <div class="tab-content bg-white">
                                    <!-- ************** general *************-->
                                    <div class="chart tab-pane active" id="general">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('full_name') ?><span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" required=""
                                                       value="<?php
                                                       if (!empty($leads_info->lead_name)) {
                                                           echo $leads_info->lead_name;
                                                       }
                                                       ?>" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('email') ?><span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="email" class="form-control person" required=""
                                                       value="<?php
                                                       if (!empty($leads_info->email)) {
                                                           echo $leads_info->email;
                                                       }
                                                       ?>" name="email">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><?= lang('language') ?></label>
                                            <div class="col-sm-5">
                                                <select name="language" class="form-control person select_box"
                                                        style="width: 100%">
                                                    <?php foreach ($languages as $lang) : ?>
                                                        <option
                                                            value="<?= $lang->name ?>"<?php
                                                        if (!empty($client_info->language) && $client_info->language == $lang->name) {
                                                            echo 'selected';
                                                        } elseif (empty($client_info->language) && $this->config->item('language') == $lang->name) {
                                                            echo 'selected';
                                                        } ?>
                                                        ><?= ucfirst($lang->name) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('currency') ?></label>
                                            <div class="col-lg-9">
                                                <select name="currency" class="form-control person select_box"
                                                        style="width: 100%">

                                                    <?php if (!empty($currencies)): foreach ($currencies as $currency): ?>
                                                        <option
                                                            value="<?= $currency->code ?>"
                                                            <?php
                                                            if (!empty($client_info->currency) && $client_info->currency == $currency->code) {
                                                                echo 'selected';
                                                            } elseif (empty($client_info->currency) && $this->config->item('default_currency') == $currency->code) {
                                                                echo 'selected';
                                                            } ?>
                                                        ><?= $currency->name ?></option>
                                                        <?php
                                                    endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('short_note') ?></label>
                                            <div class="col-lg-9">
                                            <textarea class="form-control person" name="short_note"><?php
                                                if (!empty($leads_info->notes)) {
                                                    echo $leads_info->notes;
                                                }
                                                ?></textarea>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('profile_photo') ?></label>
                                            <div class="col-lg-7">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 210px;">
                                                        <?php if (!empty($client_info->profile_photo)) : ?>
                                                            <img
                                                                src="<?php echo base_url() . $client_info->profile_photo; ?>">
                                                        <?php else: ?>
                                                            <img src="http://placehold.it/350x260"
                                                                 alt="Please Connect Your Internet">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                         style="width: 210px;"></div>
                                                    <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">
                                                            <input class="person" type="file" name="profile_photo"
                                                                   data-buttonText="<?= lang('choose_file') ?>"
                                                                   id="myImg">
                                                            <span class="fileinput-exists"><?= lang('change') ?></span>
                                                        </span>
                                                        <a href="#" class="btn btn-default fileinput-exists"
                                                           data-dismiss="fileinput"><?= lang('remove') ?></a>

                                                    </div>

                                                    <div id="valid_msg" style="color: #e11221"></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- ************** general *************-->

                                    <!-- ************** Contact *************-->
                                    <div class="chart tab-pane" id="contact">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('phone') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" required=""
                                                       value="<?php
                                                       if (!empty($leads_info->phone)) {
                                                           echo $leads_info->phone;
                                                       }
                                                       ?>" name="phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('mobile') ?><span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" required=""
                                                       value="<?php
                                                       if (!empty($leads_info->mobile)) {
                                                           echo $leads_info->mobile;
                                                       }
                                                       ?>" name="mobile">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('fax') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($client_info->fax)) {
                                                    echo $client_info->fax;
                                                }
                                                ?>" name="fax">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('city') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($leads_info->city)) {
                                                    echo $leads_info->city;
                                                }
                                                ?>" name="city">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('country') ?></label>
                                            <div class="col-lg-9">
                                                <select name="country" class="form-control person select_box"
                                                        style="width: 100%">
                                                    <optgroup label="Default Country">
                                                        <option
                                                            value="<?= $this->config->item('company_country') ?>"><?= $this->config->item('company_country') ?></option>
                                                    </optgroup>
                                                    <optgroup label="<?= lang('other_countries') ?>">
                                                        <?php if (!empty($countries)): foreach ($countries as $country): ?>
                                                            <option
                                                                value="<?= $country->value ?>" <?= (!empty($leads_info->country) && $leads_info->country == $country->value ? 'selected' : NULL) ?>><?= $country->value ?>
                                                            </option>
                                                            <?php
                                                        endforeach;
                                                        endif;
                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('zipcode') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($client_info->zipcode)) {
                                                    echo $client_info->zipcode;
                                                }
                                                ?>" name="zipcode">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('address') ?></label>
                                            <div class="col-lg-9">
                                            <textarea class="form-control person" name="address"><?php
                                                if (!empty($leads_info->address)) {
                                                    echo $leads_info->address;
                                                }
                                                ?></textarea>
                                            </div>
                                        </div>
                                    </div><!-- ************** Contact *************-->
                                    <!-- ************** Web *************-->
                                    <div class="chart tab-pane" id="web">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('website') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($client_info->website)) {
                                                    echo $client_info->website;
                                                }
                                                ?>" name="website">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('skype_id') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($leads_info->skype)) {
                                                    echo $leads_info->skype;
                                                }
                                                ?>" name="skype_id">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('facebook_profile_link') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($leads_info->facebook)) {
                                                    echo $leads_info->facebook;
                                                }
                                                ?>" name="facebook">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('twitter_profile_link') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($leads_info->twitter)) {
                                                    echo $leads_info->twitter;
                                                }
                                                ?>" name="twitter">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('linkedin_profile_link') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($client_info->linkedin)) {
                                                    echo $client_info->linkedin;
                                                }
                                                ?>" name="linkedin">
                                            </div>
                                        </div>
                                    </div><!-- ************** Web *************-->
                                    <!-- ************** Hosting *************-->
                                    <div class="chart tab-pane" id="hosting">
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('hosting_company') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($client_info->hosting_company)) {
                                                    echo $client_info->hosting_company;
                                                }
                                                ?>" name="hosting_company">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('hostname') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($client_info->hostname)) {
                                                    echo $client_info->hostname;
                                                }
                                                ?>" name="hostname">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('username') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($client_info->username)) {
                                                    echo $client_info->username;
                                                }
                                                ?>" name="username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('password') ?></label>
                                            <div class="col-lg-9">
                                                <input type="password" class="form-control person" value="<?php
                                                if (!empty($client_info->password)) {
                                                    echo $client_info->password;
                                                }
                                                ?>" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('port') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control person" value="<?php
                                                if (!empty($client_info->port)) {
                                                    echo $client_info->port;
                                                }
                                                ?>" name="port">
                                            </div>
                                        </div>
                                    </div><!-- ************** Hosting *************-->
                                </div>
                            </div><!-- /.nav-tabs-custom -->

                        </div><!--- /************ Person End ***************/ --->

                        <!--- /************ Company Start ***************/ --->
                        <div class="company" style="<?php
                        if (!empty($company)) {
                            echo 'display:block';
                        } else {
                            echo 'display:none';
                        }
                        ?>">
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#general_compnay" data-toggle="tab">General</a>
                                    </li>
                                    <li><a href="#contact_compnay" data-toggle="tab">Contact</a></li>
                                    <li><a href="#web_compnay" data-toggle="tab">Web</a></li>
                                    <li><a href="#hosting_compnay" data-toggle="tab">Hosting</a></li>
                                </ul>
                                <div class="tab-content bg-white">
                                    <!-- ************** general *************-->
                                    <div class="chart tab-pane active" id="general_compnay">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('company_name') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" required=""
                                                       value="<?php
                                                       if (!empty($leads_info->lead_name)) {
                                                           echo $leads_info->lead_name;
                                                       }
                                                       ?>" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('company_email') ?>
                                            </label>
                                            <div class="col-lg-9">
                                                <input type="email" class="form-control company" required=""
                                                       value="<?php
                                                       if (!empty($leads_info->email)) {
                                                           echo $leads_info->email;
                                                       }
                                                       ?>" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('company_vat') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($client_info->vat)) {
                                                    echo $client_info->vat;
                                                }
                                                ?>" name="vat">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><?= lang('language') ?></label>
                                            <div class="col-sm-5">
                                                <select name="language" class="form-control company select_box"
                                                        style="width: 100%">
                                                    <?php foreach ($languages as $lang) : ?>
                                                        <option
                                                            value="<?= $lang->name ?>"<?php
                                                        if (!empty($client_info->language) && $client_info->language == $lang->name) {
                                                            echo 'selected';
                                                        } elseif (empty($client_info->language) && $this->config->item('language') == $lang->name) {
                                                            echo 'selected';
                                                        } ?>
                                                        ><?= ucfirst($lang->name) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('currency') ?></label>
                                            <div class="col-lg-9">
                                                <select name="currency" class="form-control company select_box"
                                                        style="width: 100%">

                                                    <?php if (!empty($currencies)): foreach ($currencies as $currency): ?>
                                                        <option
                                                            value="<?= $currency->code ?>"
                                                            <?php
                                                            if (!empty($client_info->currency) && $client_info->currency == $currency->code) {
                                                                echo 'selected';
                                                            } elseif (empty($client_info->currency) && $this->config->item('default_currency') == $currency->code) {
                                                                echo 'selected';
                                                            } ?>
                                                        ><?= $currency->name ?></option>
                                                        <?php
                                                    endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('short_note') ?></label>
                                            <div class="col-lg-9">
                                            <textarea class="form-control company" name="short_note"><?php
                                                if (!empty($leads_info->notes)) {
                                                    echo $leads_info->notes;
                                                }
                                                ?></textarea>
                                            </div>
                                        </div>
                                    </div><!-- ************** general *************-->

                                    <!-- ************** Contact *************-->
                                    <div class="chart tab-pane" id="contact_compnay">
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('company_phone') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($leads_info->phone)) {
                                                    echo $leads_info->phone;
                                                }
                                                ?>" name="phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('company_mobile') ?>
                                                <span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" required=""
                                                       value="<?php
                                                       if (!empty($leads_info->mobile)) {
                                                           echo $leads_info->mobile;
                                                       }
                                                       ?>" name="mobile">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('company_fax') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($client_info->fax)) {
                                                    echo $client_info->fax;
                                                }
                                                ?>" name="fax">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('company_city') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($leads_info->city)) {
                                                    echo $leads_info->city;
                                                }
                                                ?>" name="city">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('company_country') ?></label>
                                            <div class="col-lg-9">
                                                <select name="country" class="form-control company select_box"
                                                        style="width: 100%">
                                                    <optgroup label="Default Country">
                                                        <option
                                                            value="<?= $this->config->item('company_country') ?>"><?= $this->config->item('company_country') ?></option>
                                                    </optgroup>
                                                    <optgroup label="<?= lang('other_countries') ?>">
                                                        <?php if (!empty($countries)): foreach ($countries as $country): ?>
                                                            <option
                                                                value="<?= $country->value ?>" <?= (!empty($leads_info->country) && $leads_info->country == $country->value ? 'selected' : NULL) ?>><?= $country->value ?>
                                                            </option>
                                                            <?php
                                                        endforeach;
                                                        endif;
                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('company_address') ?></label>
                                            <div class="col-lg-9">
                                            <textarea class="form-control company" name="address"><?php
                                                if (!empty($leads_info->address)) {
                                                    echo $leads_info->address;
                                                }
                                                ?></textarea>
                                            </div>
                                        </div>
                                    </div><!-- ************** Contact *************-->
                                    <!-- ************** Web *************-->
                                    <div class="chart tab-pane" id="web_compnay">
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('company_domain') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($client_info->website)) {
                                                    echo $client_info->website;
                                                }
                                                ?>" name="website">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('skype_id') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($leads_info->skype)) {
                                                    echo $leads_info->skype;
                                                }
                                                ?>" name="skype_id">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('facebook_profile_link') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($leads_info->facebook)) {
                                                    echo $leads_info->facebook;
                                                }
                                                ?>" name="facebook">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('twitter_profile_link') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($leads_info->twitter)) {
                                                    echo $leads_info->twitter;
                                                }
                                                ?>" name="twitter">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('linkedin_profile_link') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($client_info->linkedin)) {
                                                    echo $client_info->linkedin;
                                                }
                                                ?>" name="linkedin">
                                            </div>
                                        </div>
                                    </div><!-- ************** Web *************-->
                                    <!-- ************** Hosting *************-->
                                    <div class="chart tab-pane" id="hosting_compnay">
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('hosting_company') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($client_info->hosting_company)) {
                                                    echo $client_info->hosting_company;
                                                }
                                                ?>" name="hosting_company">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('hostname') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($client_info->hostname)) {
                                                    echo $client_info->hostname;
                                                }
                                                ?>" name="hostname">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('username') ?> </label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($client_info->username)) {
                                                    echo $client_info->username;
                                                }
                                                ?>" name="username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="col-lg-3 control-label"><?= lang('password') ?></label>
                                            <div class="col-lg-9">
                                                <input type="password" class="form-control company" value="<?php
                                                if (!empty($client_info->password)) {
                                                    echo $client_info->password;
                                                }
                                                ?>" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?= lang('port') ?></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control company" value="<?php
                                                if (!empty($client_info->port)) {
                                                    echo $client_info->port;
                                                }
                                                ?>" name="port">
                                            </div>
                                        </div>
                                    </div><!-- ************** Hosting *************-->
                                </div>
                            </div><!-- /.nav-tabs-custom -->
                        </div><!--- /************ Company End ***************/ --->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                        <button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
                    </div>

            </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var client_stusus = $('#client_stusus').val();
        if (client_stusus == '2') {
            $(".company").removeAttr('disabled');
        } else {
            $(".company").attr('disabled', 'disabled');
            $('.company').hide()
        }
        $('#client_stusus').change(function () {
            if ($('#client_stusus').val() == '1') {
                $('.person').show();
                $('.company').hide();
                $(".company").attr('disabled', 'disabled');
                $(".person").removeAttr('disabled');
            } else {
                $('.person').hide();
                $('.company').show();
                $(".person").attr('disabled', 'disabled');
                $(".company").removeAttr('disabled');
            }
        });
    });
</script>