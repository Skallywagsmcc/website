<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title") </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/custom/css/backend/backend.css"/>
    <script src="/Resources/js/jquery.js"></script
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
</head
<body>
<div id="container_wrapper" class="container-fluid mx-0 px-0">
    <div class="row mx-0 p-0">
        <div class="col-sm-12 col-md-2 sidebar mx-0 px-0">

            <div class="col-sm-12 img-fluid d-flex justify-content-center">
                <img src="/img/logo.png" class="img-fluid my-2 p-2" height="100" width="100" alt="Logo">
            </div>
            <div class="col-sm-12 text-center"><h5>User Control Panel</h5></div>

            <div id="navbar">
                <div class="nav-menu">
                    <div class="nav-toggle py-2"><a href="#">Profile Information</a></div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{$url->make("account.basic.home")}}">The Basics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{$url->make("account.about.home")}}">Update About me</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="navbar">
                <div class="nav-menu">
                    <div class="nav-toggle py-2"><a href="#">Security and Settings</a></div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Update Email</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Request a new Username</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{$url->make("account.settings.home")}}">Account Settings</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-10">
      @yield("content")
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate deleniti eligendi facilis
                inventore minima, minus natus neque nesciunt nobis possimus quam ratione repellat repellendus
                reprehenderit saepe sapiente tenetur vel vitae.
            </div>
            <div>Ducimus earum expedita ipsa iste non quibusdam quidem! A, accusantium culpa delectus et necessitatibus
                neque odio officiis optio? Architecto eos facilis id libero nemo pariatur reprehenderit tempora. Dolore,
                laboriosam, reiciendis?
            </div>
            <div>A alias animi aperiam architecto aspernatur commodi consequatur, doloremque ea eius eum impedit minima
                nostrum perspiciatis quae quos ratione rem sapiente sequi sint temporibus ut veniam voluptate
                voluptates? Nobis, tempora?
            </div>
            <div>Asperiores aspernatur at beatae consectetur consequuntur cum dolor eius et eum, eveniet excepturi
                incidunt libero minus natus officiis omnis porro qui quibusdam quidem, quis quos rerum saepe sed
                similique soluta?
            </div>
            <div>Aliquid assumenda, atque beatae deleniti dolorem eos eveniet ipsa ipsam laudantium magni maiores,
                molestias nam nisi numquam officia praesentium, quaerat quia quo recusandae sequi sint tenetur veniam
                voluptas voluptatibus voluptatum?
            </div>
            <div>Aliquam consequatur corporis, culpa debitis, ea eaque explicabo fuga incidunt ipsum laudantium
                molestiae nesciunt nostrum, nulla omnis quia quod rem repellat rerum suscipit veritatis? Aliquam
                aspernatur distinctio obcaecati rem vitae!
            </div>
            <div>A asperiores corporis culpa delectus dolorem doloremque ea earum enim error esse et explicabo facilis
                impedit magni mollitia nam nesciunt nihil, nostrum numquam odit, quam quasi repellendus sit suscipit
                velit.
            </div>
            <div>Cumque ducimus earum excepturi fugiat numquam odio pariatur quam quas rem tempora? Architecto
                cupiditate maxime quam reiciendis. Consequuntur deleniti maiores nam neque nobis nulla placeat possimus
                praesentium, qui sequi suscipit?
            </div>
            <div>Commodi debitis dicta ex fuga laborum nulla obcaecati tempore! Aliquam aperiam beatae blanditiis
                deserunt dicta doloremque est ex, illum laboriosam laudantium molestiae nesciunt numquam omnis quasi rem
                saepe sunt totam.
            </div>
            <div>Doloremque eaque facere iste iure laudantium modi praesentium ut. Animi, cum dolorum illum ipsum
                perspiciatis quam quis temporibus. Alias aliquam beatae cum dolor ducimus eaque ipsum odit quas? Error,
                sint.
            </div>
            <div>Accusamus commodi consequuntur esse magnam reprehenderit sit, tenetur. Accusamus aspernatur, assumenda
                atque consectetur corporis ea eveniet, fugit, hic ipsam molestias necessitatibus obcaecati quasi quidem
                rerum sint tenetur totam vel voluptas!
            </div>
            <div>Accusantium, amet consequuntur ducimus iusto nam natus officia perferendis quos sed. Ad corporis eius
                enim eveniet labore maxime molestiae odit, officiis perferendis perspiciatis quasi quis sed, sint
                tempore tenetur, voluptates.
            </div>
            <div>Ad, at consequuntur culpa dolorem magni praesentium quis ratione similique? Non nostrum quas ratione
                reiciendis sit veniam voluptatibus! Aut blanditiis corporis eius error fuga impedit molestias
                necessitatibus nesciunt nobis porro!
            </div>
            <div>Aliquid cupiditate dignissimos distinctio esse ipsum, libero omnis quae. Assumenda aut eligendi error,
                ex facilis iusto libero molestiae nihil nobis non obcaecati porro qui quia recusandae reiciendis,
                repellendus sed, soluta.
            </div>
            <div>Ab accusamus accusantium aperiam aut blanditiis corporis delectus doloremque earum explicabo id illum
                laborum minus natus nesciunt obcaecati, odit pariatur possimus quis quo sapiente sequi sint sunt ullam
                velit veritatis?
            </div>
            <div>Adipisci aperiam aspernatur beatae consectetur debitis deserunt earum harum illo iusto minima mollitia
                officia provident quidem quod repellat, sequi sunt voluptates. Alias, dolores earum eligendi et
                exercitationem nesciunt odit pariatur.
            </div>
            <div>Atque aut eligendi hic inventore magni neque nobis officiis quisquam! Accusamus ad alias animi
                architecto consectetur cum, eaque esse explicabo impedit ipsum nam necessitatibus, nostrum perspiciatis
                saepe sapiente velit voluptas?
            </div>
            <div>Ad beatae eligendi id ipsum magnam officiis perferendis! Accusamus ad aliquid deserunt dolorum ducimus
                ea eaque, esse, facere fugiat laborum maiores mollitia necessitatibus officia quas similique soluta
                temporibus vel voluptas?
            </div>
            <div>Dicta est eveniet excepturi illum incidunt laudantium nihil perferendis sequi, tenetur. A deleniti
                distinctio doloremque hic odit ratione repellat temporibus tenetur, ullam? Aliquam doloribus laboriosam
                praesentium quam, ullam vero voluptate?
            </div>
            <div>A adipisci aliquid aspernatur autem consectetur cum deleniti, deserunt dolor ea earum eum explicabo
                fuga illo illum labore laudantium libero maiores mollitia necessitatibus, neque nulla, omnis possimus
                saepe sunt unde.
            </div>
            <div>A ab accusantium alias aperiam atque aut consectetur culpa doloribus fugiat fugit id impedit iusto
                laudantium magni minima, neque nostrum omnis pariatur perferendis praesentium quam quis repellendus
                sapiente, sunt unde.
            </div>
            <div>Alias, aspernatur culpa cupiditate fugiat nihil perferendis porro possimus veritatis. Autem culpa
                dolorem doloribus eum iure minus perferendis quos rem sunt vel? Accusamus adipisci animi blanditiis
                consequatur inventore quasi ut.
            </div>
            <div>Accusamus aut delectus deleniti deserunt eos et ex facilis impedit, iusto magni modi necessitatibus
                nihil nulla praesentium provident quam repellat sed tempora voluptate voluptates. Deserunt eius modi
                porro quam veniam.
            </div>
            <div>At atque corporis cupiditate dolorem enim ipsam nisi numquam quidem reprehenderit sequi! Quasi quod,
                quos. Aliquid beatae debitis dolore dolores explicabo, maxime mollitia nisi obcaecati, officiis
                reiciendis suscipit vero, voluptatum.
            </div>
            <div>Adipisci at atque dicta dolore eveniet excepturi exercitationem laudantium libero numquam, omnis optio
                pariatur quam quis quo quod recusandae sed ullam ut! Dolores dolorum eveniet ipsa nostrum placeat
                possimus similique?
            </div>
            <div>Atque consequatur cupiditate dignissimos dolores eligendi ex excepturi fugiat impedit ipsam iusto
                laudantium mollitia necessitatibus nulla obcaecati perferendis quae quas reiciendis, repudiandae, rerum
                sed similique soluta tempore temporibus, ullam velit.
            </div>
            <div>Aspernatur, ea eaque eos, eveniet ipsum iure magni minus omnis provident quae quibusdam quisquam
                recusandae veritatis vero voluptatum? Consequatur deleniti iure laboriosam magnam nemo nisi quibusdam
                reiciendis ut veritatis vitae.
            </div>
            <div>Doloribus dolorum et exercitationem, facere harum ipsa labore laboriosam magni molestias omnis pariatur
                quae quia sunt suscipit vitae! Aut hic id illum nobis, rem rerum sit! Dolorum quos totam voluptate?
            </div>
            <div>A amet delectus eius ex id laboriosam laudantium, molestias numquam officia perferendis praesentium
                quaerat recusandae, repudiandae soluta unde. Ducimus eius est explicabo facere natus quisquam unde,
                voluptates. Adipisci, amet sequi?
            </div>
            <div>A animi exercitationem fugiat in, nemo odio perspiciatis quas, recusandae repudiandae sapiente tenetur
                vel? Assumenda beatae cumque enim eveniet expedita illum itaque magnam necessitatibus nulla perspiciatis
                quos vel, vero! Inventore.
            </div>
            <div>Aliquam assumenda beatae culpa deleniti eaque, expedita fuga fugit iure mollitia natus nesciunt numquam
                officia perferendis quasi qui quos, repellendus similique tenetur vel velit vero voluptate voluptatum!
                Architecto, quae, tempore.
            </div>
            <div>Aliquam amet consectetur dignissimos dolorem, explicabo illum nam necessitatibus non perspiciatis
                provident quia similique suscipit velit! Aliquid aspernatur blanditiis cumque dignissimos eum facere
                iste modi molestias, quae qui reiciendis sequi?
            </div>
            <div>Aut doloribus maxime mollitia neque obcaecati, sed voluptas? Doloremque dolores enim quis tenetur?
                Deserunt molestias praesentium quo repellendus soluta. Deserunt et id illum iure maiores neque pariatur
                provident quod voluptas.
            </div>
            <div>Accusamus alias, beatae blanditiis consectetur deserunt exercitationem fugiat iste nam nemo numquam
                omnis perspiciatis quae quas repellendus sequi. Architecto aspernatur dolores earum facere laboriosam
                necessitatibus ratione repellendus sequi veritatis voluptates.
            </div>
            <div>Animi, beatae eum eveniet labore, laboriosam magnam nostrum officiis possimus quas quia quidem
                repudiandae temporibus, ut. Aspernatur autem corporis dicta eos laborum laudantium libero quae
                reiciendis sequi vitae. Ab, voluptates.
            </div>
            <div>Atque deserunt, doloribus ducimus inventore ipsam minus molestias, provident quae quia veniam
                voluptatem voluptates. Adipisci architecto deleniti dolorum error expedita facilis ipsam laboriosam quos
                sit ut. Ab atque mollitia officiis?
            </div>
            <div>Animi dolore dolores dolorum eaque fugiat, harum, nemo nihil placeat quas quibusdam recusandae
                repellendus rerum tenetur. Cumque deserunt dolores error eum expedita labore minima nam numquam quia,
                quod, quos, rerum?
            </div>
            <div>Accusamus aliquid autem blanditiis distinctio, enim esse explicabo in incidunt laborum optio
                perspiciatis porro sapiente. Ad culpa, dignissimos dolorem eaque enim fuga fugiat id non quis
                reprehenderit sint unde voluptate.
            </div>
            <div>Asperiores consequatur eligendi et eveniet facilis fuga, iure laborum nemo nisi perferendis
                perspiciatis quas ratione rerum saepe sapiente similique soluta velit voluptatem! Doloribus eligendi
                nostrum provident sapiente, soluta vel veniam.
            </div>
            <div>Consequuntur incidunt laborum unde. Accusantium commodi distinctio facilis fugit maiores minima,
                obcaecati sed sit sunt totam? Est molestiae natus perferendis quam quasi quisquam recusandae. Eius ex
                facere harum natus odit?
            </div>
            <div>Commodi doloremque exercitationem harum in laborum nisi quam quos suscipit vel vitae! Accusantium
                aliquid autem eveniet itaque iure modi quae quaerat quasi ullam unde! Enim molestias odit quas sequi
                voluptatibus.
            </div>
            <div>Accusantium numquam pariatur vel? Atque cum debitis deleniti dicta dignissimos et eveniet ex facere
                incidunt ipsam iste neque nihil nulla, odit perferendis quasi recusandae repellat, tempora totam vero.
                Omnis, quasi.
            </div>
            <div>Architecto facere maiores nesciunt officia possimus recusandae sapiente. Debitis ducimus eveniet
                exercitationem facilis fuga necessitatibus nihil officiis placeat, ratione temporibus tenetur voluptates
                voluptatum? Beatae dolore iusto nihil qui quia, sequi.
            </div>
            <div>Asperiores commodi deleniti dolorem doloremque ea eaque facere officia perferendis placeat quam
                quibusdam ullam, veniam! Adipisci maxime obcaecati optio praesentium quibusdam reiciendis unde vel,
                veniam. Consequatur delectus dolores esse temporibus.
            </div>
            <div>Consectetur illo impedit in magni non porro quia quidem quis similique, sint, temporibus voluptates!
                Est nemo officia praesentium quod voluptatum! Ab cupiditate dicta excepturi expedita in molestias nisi
                saepe tenetur!
            </div>
            <div>Autem cumque ducimus, enim et ex labore minus molestias numquam odit quis ratione, reprehenderit soluta
                tempora. Alias excepturi fuga id labore mollitia neque nesciunt sit sunt? Eius illum reprehenderit
                vitae.
            </div>
            <div>Aspernatur modi optio quis sunt veritatis voluptate. Accusantium assumenda delectus dolorem eaque ex
                illum inventore, ipsa maiores nihil odio placeat quaerat quia quisquam rerum saepe tenetur vel.
                Molestiae, recusandae, unde!
            </div>
            <div>Accusamus commodi consectetur dicta ipsam, quis sapiente sit? Aspernatur blanditiis commodi fugiat
                nulla optio praesentium quae rerum similique vitae voluptate! A, dolore eos impedit obcaecati quasi quod
                sapiente. Repellendus, vel.
            </div>
            <div>Accusantium, alias culpa ea libero quaerat repellendus soluta ullam velit veniam veritatis? Alias,
                atque consequatur earum eos eum harum ipsa magni possimus provident recusandae rem saepe similique
                veniam voluptatem voluptates!
            </div>
            <div>Expedita iure non recusandae tempore? Eligendi fuga id libero magnam minima minus nesciunt quia soluta
                voluptate voluptates? A alias aspernatur dolor dolore error laborum quo, reprehenderit! Ad libero nihil
                veritatis.
            </div>
            <div>Accusamus, ad aperiam assumenda atque dolorem eligendi esse excepturi explicabo facere fugit itaque
                laudantium libero placeat sapiente, unde veniam voluptas. Consectetur cupiditate deserunt, fugiat nobis
                quae quas quidem repudiandae vel.
            </div>
            <div>Deserunt distinctio enim libero natus possimus quibusdam, quod soluta. Aliquam, aspernatur assumenda
                cum cupiditate dolorum ducimus ea ex harum id itaque laudantium numquam perferendis porro qui, quidem,
                totam unde. Suscipit?
            </div>
            <div>Adipisci alias aliquid delectus deserunt enim, est et eveniet, harum id illo impedit in iure laudantium
                neque nobis nostrum odit quae quaerat quod quos rem repellendus sapiente similique sint voluptatibus.
            </div>
            <div>A dolorum earum in ipsam laudantium, maxime nesciunt repellat repudiandae? Debitis deleniti deserunt
                ducimus enim facere labore odit quas quis sequi unde? Dignissimos facilis id iure magnam officiis
                perspiciatis ut!
            </div>
            <div>Aut dicta error laboriosam minima molestias placeat ullam voluptate. Assumenda autem et expedita
                explicabo facilis nemo nisi qui veritatis. Commodi esse et exercitationem facere quaerat reiciendis rem
                sed, veritatis voluptatum.
            </div>
            <div>Adipisci aperiam asperiores aspernatur blanditiis cupiditate debitis dolore earum eligendi enim ex
                harum impedit in iure laborum laudantium libero modi, nesciunt odio placeat porro praesentium quidem
                ratione, saepe unde voluptatem?
            </div>
            <div>Alias dicta eligendi molestiae odit. Aut doloribus dolorum expedita ipsa nostrum obcaecati odit
                pariatur porro quasi veniam. Animi, assumenda corporis dicta fugiat libero nihil nobis porro quas,
                quibusdam vero voluptatum!
            </div>
            <div>Assumenda dicta illum minus neque odio placeat quae qui repellendus ut voluptatem. Aperiam autem
                consectetur consequatur, ea eius esse magnam molestias nulla numquam odio perferendis porro quia quos
                recusandae, repellendus?
            </div>
            <div>Deleniti expedita maiores natus odit quam quis sint sit velit vero? Asperiores, eos sequi. Aut dolores
                exercitationem nobis omnis quasi quia sit velit? Cumque, distinctio facere inventore iure nihil numquam.
            </div>
            <div>Adipisci aperiam aut autem consectetur culpa deleniti dolorem doloremque eos expedita id incidunt ipsum
                quasi saepe soluta, vitae. Aliquid architecto consectetur harum nobis quas sequi, temporibus? A aliquid
                similique voluptate.
            </div>
        </div>
    </div>
</div>
    <div class="row footer mx-0 px-0">
        {{$_SERVER['APP_NAME']}}} {{$_SERVER['VERSION']}} | Backend Powered by "name goes here"
    </div>


</body>
</html>