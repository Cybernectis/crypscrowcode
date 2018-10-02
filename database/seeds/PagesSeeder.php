<?php

use Illuminate\Database\Seeder;
use App\Page;
use App\PageSection;
class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page 			= new Page;
        $page->name 	= "FAQ";
        $page->slug 	= "faq";
        $page->save();

        $pageSection 				= new PageSection;
        $pageSection->page_id 		= $page->id;
        $pageSection->name 			= "FAQ";
        $pageSection->type 			= "textarea";
        $pageSection->meta_key 		= "faq";
        $pageSection->meta_value 	= ' <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <h4>Getting started</h4>
                    <ul>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     What is CrypScrow.com?
                                 </a>
                            <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    CrypScrow is an independent peer-to-peer marketplace which serves as a platform where you can trade cryptocurrencies in exchange for fiat money via escrow smart contracts. Trades can be done via several methods such as bank transfers, cash payments or cash deposits, PayPal, Alipay, etc.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsetwo" aria-expanded="true" aria-controls="collapseOne">
                                     Do I pay any fees?
                                 </a>
                            <div id="collapsetwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    CrypScrow charges a 0.70% maker price and 0.30% taker price. The maker price is charged to the one who puts on the offer listing, while the taker price is charged to the person responding to the offer.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">
                                     What do those symbols stand for?
                                 </a>
                            <div id="collapsethree" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    These symbols are called “character icons”. They give identity to addresses. A slight change in address will display a different character icon. They are useful in making sure you are sending funds to a correct address. This will reduce the chances of sending funds to an incorrect address.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <h4>Using CrypScrow</h4>
                    <ul>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapseOne">
                                     Can I change my username?
                                 </a>
                            <div id="collapsefour" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    A change in username is currently not supported.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                                     Why do buyers and sellers see different prices?
                                 </a>
                            <div id="collapsefive" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    Offer and trade rates, are prices which are fixed on default, are the reasons buyers and sellers see different price for the same trade. What you see as prices will be what you will receive after CrypScrow fee is deducted.
                                </p>
                                <br>
                                <p>CrypScrow charges 0.30% for the maker and 0.70% for the taker.</p>
                                <br>
                                <p>The fee system works like this:</p>
                                <br>
                                <ol style="color: #827da9;font-family: \'Open Sans\', sans-serif;font-weight: 400;  font-size: 14px;line-height: 24px;">
                                    <li>When the maker is the buyer: Seller\'s rate = ([Buyer\'s rate] * (1 – 0.003%) * (1 – 0.007%)</li>
                                    <li>When the maker is the buyer: Seller\'s rate = ([Buyer\'s rate] * (1 – 0.003%) * (1 – 0.007%)</li>
                                </ol>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                                     How many offers can I put up at once?
                                 </a>
                            <div id="collapsesix" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    To keep the system order, you are allowed to have only two active offers per payment means and time. If you go beyond this, any extra offer will be kept on hold.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <h4>Manage your wallet</h4>
                    <ul>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseeight" aria-expanded="true" aria-controls="collapseeight">
                                        How does CrypScrow keep my cryptocurrencies?
                                 </a>
                            <div id="collapseeight" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    Your wallet on CrypScrow.com has been fully encrypted on your browser. Like encrypted messages, your wallet is developed to allow your funds to be created offline in your browser. Neither do we nor any of our staffs have access to your funds.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsenine" aria-expanded="true" aria-controls="collapsenine">
                                     How do I deposit cryptocurrencies into my CrypScrow wallet?
                                 </a>
                            <div id="collapsenine" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    When depositing cryptocurrencies to your wallet, your wallet page is the key. Currency address should be easily fetched via an address. You can use any of the addresses listed on your wallet page. For proper security, we recommend using the “unused” address that can be seen at the top. For each deposits, use new address and dispose old ones.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseten" aria-expanded="true" aria-controls="collapseten">
                                     Is a wrongly sent fund reversible?
                                 </a>
                            <div id="collapseten" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    Digital transactions are generally irreversible. If you send funds to a wrong address, contact the party and wait for them to return it. However, there is a slim chance of retrieving if sent to a wrong address and CrypScrow will not be held liable for this.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseseven" aria-expanded="true" aria-controls="collapseten">
                                     What can be done to a pending transaction?
                                 </a>
                            <div id="collapseseven" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    There’s a threshold fee at which miners accept fees. If you don’t meet the threshold fee to carry out the transaction, the transaction will time out and the funds will be returned to your wallet. Exercise patience if it’s just been in few hours.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <h4>Security</h4>
                    <ul>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsetwelve" aria-expanded="true" aria-controls="collapsetwelve">
                                     Is my privacy safe?
                                 </a>
                            <div id="collapsetwelve" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    Your messages are as safe as your hidden bunker. Several checks were placed while designing this trade centre. These includes:
                                </p>
                                <ol>
                                    <li>End-to-end message encryption</li>
                                    <li>Messaging forward secrecy</li>
                                    <li>Financial forward secrecy</li>
                                    <li>Signature system</li>
                                </ol>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsethirteen" aria-expanded="true" aria-controls="collapsethirteen">
                                     How are end-to-end messages protected?
                                 </a>
                            <div id="collapsethirteen" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <p>
                                    Put simply, your message is encrypted into your browser. No one, our team inclusive, can read your messages. When viewed from our servers, those messages are bunches of random numbers of matrices. Once you destroy messages keys, the conservation is gone forever. However certain situations may have one of the parties release the key to our team, only on these occasions can we read your messages.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>';

        $pageSection->save();
        $page 			= new Page;
        $page->name 	= "Terms & Policy";
        $page->slug 	= "terms";
        $page->save();

        $pageSection 				= new PageSection;
        $pageSection->page_id 		= $page->id;
        $pageSection->name 			= "Terms";
        $pageSection->meta_key 		= "terms";
        $pageSection->type 			= "textarea";
        $pageSection->meta_value 	= '<div class="col-md-10 col-md-offset-1">
                <h3>Terms & Conditions</h3>
                <p>
                    Throughout the Terms of Service, the terms "crypscrow.com", "we", "us" and "our" refer to the crypscrow.com website and its operators.
                </p>
                <p>
                    By visiting our website, you engage in our "Service" and agree to be bound by the following terms and conditions ("Terms of Service", "Terms"). These Terms of Service apply to all users of the website, including without limitation users who are visitors, browsers, vendors, customers, merchants, brokers, traders, and/or contributors of content (collectively "users").
                </p>
                <p>
                    crypscrow.com is a service that enables its users to find others willing to trade available crypto currency such as “bitcoin”, "litecoin", "dodgecoin", "ether", "ripple", "zcash", "dash" and "monero" for local currency and vice versa.
                </p>
                <h3>Local laws</h3>
                <p>
                    Services provided by crypscrow.com and its users may not be legally permissible in some jurisdictions. By visiting our website, you confirm that using the services provided by crypscrow.com and its users would not be in breach of your local laws. You confirm that you are complying with all of your local laws and regulations at all times when using the website.
                </p>
                <p>
                    Nothing on our website is intended to constitute legal or financial advice. The information on our website, and the posting and viewing of any the information on our website, should not be construed as, and should not be relied upon for, legal, financial or tax advice in any particular circumstance or fact situation. Nothing on this website should be used as a substitute for the advice of competent legal counsel.
                </p>
                <h3>Trades of bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero</h3>
                <p>
                    The parties of a trade are referred to as "buyers" (those who are willing to trade local currency for bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero) and "sellers" (those who are willing to trade bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero for local currency).
                </p>
                <p>
                    When trading with a user located with the aid of crypscrow.com\'s services, payment instructions can only be communicated directly between the buyer and seller. We do not have any bank accounts that hold users\' funds, nor do we facilitate or escrow any payments between buyers and sellers. At no point during the course of a trade does the buyers\' or sellers\' bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero enter our control.
                </p>
                <p>
                    Trades are conducted via the blockchain distributed computing network of the crypto currencies i.e. of bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero, which we cannot and do not control. When a seller sends bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero to a buyer during the course of a trade, the seller transfers bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero directly to a decentralized application (a "smart contract") and those bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero are inaccessible by crypscrow.com without explicit digital permission from the buyer or seller. It is impossible for us to have bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero directed to anyone other than the seller or the buyer as per the code of the distributed smart contract.
                </p>
                <p>
                    If a dispute arises during the course of a trade, the buyers and sellers can work with a trusted third party to resolve where bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero is allocated.
                </p>
                <h3>Communications between parties</h3>
                <p>
                    All communication made between buyers and sellers on crypscrow.com is end-to-end encrypted. No third parties, including us, have the technical ability to decipher and/or read these messages.
                </p>
                <p>
                    It is the responsibility of the users to make and keep adequate records of communications and financial history to the extent that they are required to do so in their jurisdiction. It is your sole responsibility to ensure you are complying with all of the record-keeping requirements in your local jurisdiction, which may include (but is not limited to) creating and storing copies of communications and details of transactions.
                </p>
                <h3>Storage of user funds & information</h3>
                <p>
                    We do not have access to any of our users\' bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero, cryptocurrencies, token balances or money (collectively "funds"). crypscrow.com "wallets", in which the private key material to cryptocurrencies are stored, are generated and encrypted on the users\' devices and are thus inaccessible by crypscrow.com at all times.
                </p>
                <p>
                    crypscrow.com\'s users have the ability to permanently and irrevocably delete information in some cases, including but not limited to encrypted copies of information which could be used to decipher messages and cryptocurrency private key material.
                </p>
                <h3>Disclaimers</h3>
                <p>1. crypscrow.com does not facilitate or provide brokerage, exchange, payment or merchant services.</p>
                <p>2. crypscrow.com is only an introductory and information service, and, to the maximum extent permissible by law, is not responsible for any actions and services provided by any of its users.</p>
                <p>
                    3. We make no warranties, claims or guarantees related to any of our users, including but not limited to: a. the merchantability or fitness of the user; b. the reliability and timeliness of the user; c. the accuracy of any information the user presents; or d. the accuracy of any information we provide about the user.
                </p>
                <p>4. We make no guarantees to the safety, reliability, availability or longevity of any of the data we collect or store.</p>
                <p>5. The materials on our website are provided on an "as is" basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
                <p>6. We may make changes to any of the materials contained on our website at any time without notice, including these Terms of Service. An up to date version can always be found at https://crypscrow.com/terms, or by emailing contact@crypscrow.com.</p>
                <h3>Indemnity</h3>
                <p>By using crypscrow.com, you agree to be fully responsible for (and fully indemnify us against) all claims, liability, damages, losses, costs and expenses, including legal fees, suffered by us and arising out of or related to any breach of this Agreement by you or any other liabilities incurred by us arising out of your use of the services, or use by any other person accessing the services using your user account, device or internet access account; or your violation of any law or rights of any third party.</p>
                <h3>Fees and pricing</h3>
                <p>
                    We do not charge any fees in local currencies. When the escrow smart contract service is used, a percentage of bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero is allocated to crypscrow.com. crypscrow.com may convert this bitcoin, litecoin, dodgecoin, ether, ripple, zcash, dash, monero to local currency or do anything else with it at its sole discretion.
                </p>
                <h3>This agreement</h3>
                <p>In the event that any provision of these Terms of Service is determined to be unlawful, void or unenforceable, such provision shall nonetheless be enforceable to the fullest extent permitted by applicable law, and the unenforceable portion shall be deemed to be severed from these Terms of Service, such determination shall not affect the validity and enforceability of any other remaining provisions. We reserve the right, at our sole discretion, to update, change or replace any part of these Terms of Service by posting updates and changes to our website. It is your responsibility to check our website periodically for changes. Your continued use of or access to our website or the Service following the posting of any changes to these Terms of Service constitutes acceptance of those changes. The headings contained in these Terms of Service are for convenience only and shall not be interpreted to limit or otherwise affect the provisions of these Terms of Service.</p>
                <h3>Privacy policy</h3>
                <p>There are many aspects of the crypscrow.com website which can be viewed without providing personal information, however, you can voluntarily submit personally identifiable information for a better experience. Your information will never be maliciously used or sold to third parties. Users may provide personal data to crypscrow.com that may be collected and stored by us. Situations where you make, or may make, personal data available to us include any interaction with crypscrow.com. This may include, without limitation:</p>
                <ol>
                    <li>Creating an account, which may include an email, username, phone number, and blurb.</li>
                    <li>Creating an offer listing.</li>
                    <li>Creating a support request through our website or email.</li>
                    <li>Opening an issue on a trade.</li>
                    <li>Making a search for an offer.</li>
                </ol>
                <h3>Contact</h3>
                <p>Please send any questions, comments, issues, or general correspondence via email using connect@crypscrow.com .</p>
            </div>';
        $pageSection->save();
   }
}
