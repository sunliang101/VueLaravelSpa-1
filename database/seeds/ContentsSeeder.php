<?php

use App\Content;
use Illuminate\Database\Seeder;

class ContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $temp =[ '{"id": 1, "key": "躊躇う", "read": "ためらう③", "meaning":"[自他·一类] 踌躇，犹豫，游移，迟疑，踟蹰不前。（思いきりがつかなくて迷う。）", "sample": ["彼女に本当のことを伝えるか躊躇う", "以前よりも太ってしまったので同窓会へ行くのを躊躇う"]}',
        '{"id": 2, "key":"躊躇う", "read":"ためらう③", "meaning":"[自他·一类] 踌躇，犹豫，游移，迟疑，踟蹰不前。（思いきりがつかなくて迷う。） ", "sample": []}',
        '{"id": 3, "key":"スポンジ", "read":"すぽんじ◎", "meaning":"[名] sponge海绵。海绵体。海绵制成的仅剩角质骨骼之物，因多孔而极富吸水性。（海綿を骨格だけとしたもの。多孔性で吸水性に富む。） ", "sample": []}',
        '{"id": 4, "key":"取り分ける", "read":"とりわける④", "meaning":"[他动·二类] 分成份儿，（从大堆里）拣出，挑出来。（食べ物などを別の器に分けて取る。同類のものの中でも特別なものとして、別にする。） ", "sample": []}',
        '{"id": 5, "key":"躓き", "read":"つまずき◎", "meaning":"[名] 绊倒，摔倒，跌倒，跌交；失败，受挫，挫折。（つまずくこと。失敗。過失。あやまち。） ", "sample": []}',
        '{"id": 6, "key":"まんまと", "read":"まんまと①③", "meaning":"[副] 巧妙，漂亮；完全，彻底。（やった事や計略が、こちらの計算通りにうまく成就することを表す。）", "sample": []}',
        '{"id": 7, "key":"ボイコット", "read":"ぼいこっと③", "meaning":"[名·他动·三类] boycott排货，联合抵制，拒绝购买，联合排斥，集体拒绝。（広義では、何人かが集まって特定の相手を排斥したり自分たちの要求を認めさせたりするために、団結して相手方との正常な関係を一方的に停止することを指す。） ", "sample": []}',
        '{"id": 8, "key":"厳か", "read":"おごそか②", "meaning":"[形动] 庄严，严肃，肃穆，庄重，郑重。威严。（いかめしく、近づきにくいさま。威厳があるさま。） ", "sample": []}',
        '{"id": 9, "key":"ヨット", "read":"よっと①", "meaning":"[名] yacht帆船，游艇（スポーツなどに使われる、小型の帆船）。 ", "sample": []}',
        '{"id": 10, "key":"ゾッと", "read":"ゾッと◎", "meaning":"[副詞] ［副］(スル)寒さや恐怖などのために、また、強い感動を受けて、からだが震え上がるさま。「ぞ", "sample": []}',
        '{"id": 11, "key":"立ち聴きする", "read":"なし", "meaning":"[他動詞] 偷听", "sample": []}',
        '{"id": 12, "key":"論い", "read":"あげつらい", "meaning":"议论，辩论 例えば、 そういう論いは人を説得することができなかろう ", "sample": []}',
        '{"id": 13, "key":"とうとう", "read":"とうとう①", "meaning":"[副] 终于，到底，终究，结局。（最終的な結果として物事が実現した、あるいは実現しなかったという意を表す。ついに。結局。）／同：到頭", "sample": []}'];

        foreach ($temp as $t) {
            Content::create([
                'category' => 'word',
                'vue' =>  $t,
            ]);
        }
        

    }
}
