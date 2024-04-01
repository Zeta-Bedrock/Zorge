<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\BlockBreakInfo as BreakInfo;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockToolType as ToolType;
use pocketmine\block\BlockTypeInfo as Info;
use pocketmine\block\BlockTypeTags as Tags;
use pocketmine\block\tile\Banner as TileBanner;
use pocketmine\block\tile\Barrel as TileBarrel;
use pocketmine\block\tile\Beacon as TileBeacon;
use pocketmine\block\tile\Bed as TileBed;
use pocketmine\block\tile\Bell as TileBell;
use pocketmine\block\tile\BlastFurnace as TileBlastFurnace;
use pocketmine\block\tile\BrewingStand as TileBrewingStand;
use pocketmine\block\tile\Cauldron as TileCauldron;
use pocketmine\block\tile\Chest as TileChest;
use pocketmine\block\tile\ChiseledBookshelf as TileChiseledBookshelf;
use pocketmine\block\tile\Comparator as TileComparator;
use pocketmine\block\tile\DaylightSensor as TileDaylightSensor;
use pocketmine\block\tile\EnchantTable as TileEnchantingTable;
use pocketmine\block\tile\EnderChest as TileEnderChest;
use pocketmine\block\tile\FlowerPot as TileFlowerPot;
use pocketmine\block\tile\GlowingItemFrame as TileGlowingItemFrame;
use pocketmine\block\tile\Hopper as TileHopper;
use pocketmine\block\tile\ItemFrame as TileItemFrame;
use pocketmine\block\tile\Jukebox as TileJukebox;
use pocketmine\block\tile\Lectern as TileLectern;
use pocketmine\block\tile\MobHead as TileMobHead;
use pocketmine\block\tile\MonsterSpawner as TileMonsterSpawner;
use pocketmine\block\tile\NormalFurnace as TileNormalFurnace;
use pocketmine\block\tile\Note as TileNote;
use pocketmine\block\tile\ShulkerBox as TileShulkerBox;
use pocketmine\block\tile\Smoker as TileSmoker;
use pocketmine\block\tile\Tile;
use pocketmine\block\utils\AmethystTrait;
use pocketmine\block\utils\LeavesType;
use pocketmine\block\utils\SaplingType;
use pocketmine\block\utils\WoodType;
use pocketmine\crafting\FurnaceType;
use pocketmine\item\enchantment\ItemEnchantmentTags as EnchantmentTags;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\math\Facing;
use pocketmine\utils\AssumptionFailedError;
use pocketmine\utils\CloningRegistryTrait;
use function defined;
use function mb_strtolower;
use function mb_strtoupper;
use function strtolower;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @see build/generate-registry-annotations.php
 * @generate-registry-docblock
 *
 * @method static WoodenButton ACACIA_BUTTON()
 * @method static WoodenDoor ACACIA_DOOR()
 * @method static WoodenFence ACACIA_FENCE()
 * @method static FenceGate ACACIA_FENCE_GATE()
 * @method static Leaves ACACIA_LEAVES()
 * @method static Wood ACACIA_LOG()
 * @method static Planks ACACIA_PLANKS()
 * @method static WoodenPressurePlate ACACIA_PRESSURE_PLATE()
 * @method static Sapling ACACIA_SAPLING()
 * @method static FloorSign ACACIA_SIGN()
 * @method static WoodenSlab ACACIA_SLAB()
 * @method static WoodenStairs ACACIA_STAIRS()
 * @method static WoodenTrapdoor ACACIA_TRAPDOOR()
 * @method static WallSign ACACIA_WALL_SIGN()
 * @method static Wood ACACIA_WOOD()
 * @method static ActivatorRail ACTIVATOR_RAIL()
 * @method static Air AIR()
 * @method static Flower ALLIUM()
 * @method static MushroomStem ALL_SIDED_MUSHROOM_STEM()
 * @method static Opaque AMETHYST()
 * @method static AmethystCluster AMETHYST_CLUSTER()
 * @method static Opaque ANCIENT_DEBRIS()
 * @method static Opaque ANDESITE()
 * @method static Slab ANDESITE_SLAB()
 * @method static Stair ANDESITE_STAIRS()
 * @method static Wall ANDESITE_WALL()
 * @method static Anvil ANVIL()
 * @method static Leaves AZALEA_LEAVES()
 * @method static Flower AZURE_BLUET()
 * @method static Bamboo BAMBOO()
 * @method static BambooSapling BAMBOO_SAPLING()
 * @method static FloorBanner BANNER()
 * @method static Barrel BARREL()
 * @method static Transparent BARRIER()
 * @method static SimplePillar BASALT()
 * @method static Beacon BEACON()
 * @method static Bed BED()
 * @method static Bedrock BEDROCK()
 * @method static Beetroot BEETROOTS()
 * @method static Bell BELL()
 * @method static BigDripleafHead BIG_DRIPLEAF_HEAD()
 * @method static BigDripleafStem BIG_DRIPLEAF_STEM()
 * @method static WoodenButton BIRCH_BUTTON()
 * @method static WoodenDoor BIRCH_DOOR()
 * @method static WoodenFence BIRCH_FENCE()
 * @method static FenceGate BIRCH_FENCE_GATE()
 * @method static Leaves BIRCH_LEAVES()
 * @method static Wood BIRCH_LOG()
 * @method static Planks BIRCH_PLANKS()
 * @method static WoodenPressurePlate BIRCH_PRESSURE_PLATE()
 * @method static Sapling BIRCH_SAPLING()
 * @method static FloorSign BIRCH_SIGN()
 * @method static WoodenSlab BIRCH_SLAB()
 * @method static WoodenStairs BIRCH_STAIRS()
 * @method static WoodenTrapdoor BIRCH_TRAPDOOR()
 * @method static WallSign BIRCH_WALL_SIGN()
 * @method static Wood BIRCH_WOOD()
 * @method static Opaque BLACKSTONE()
 * @method static Slab BLACKSTONE_SLAB()
 * @method static Stair BLACKSTONE_STAIRS()
 * @method static Wall BLACKSTONE_WALL()
 * @method static Furnace BLAST_FURNACE()
 * @method static BlueIce BLUE_ICE()
 * @method static Flower BLUE_ORCHID()
 * @method static Torch BLUE_TORCH()
 * @method static BoneBlock BONE_BLOCK()
 * @method static Bookshelf BOOKSHELF()
 * @method static BrewingStand BREWING_STAND()
 * @method static Opaque BRICKS()
 * @method static Slab BRICK_SLAB()
 * @method static Stair BRICK_STAIRS()
 * @method static Wall BRICK_WALL()
 * @method static BrownMushroom BROWN_MUSHROOM()
 * @method static BrownMushroomBlock BROWN_MUSHROOM_BLOCK()
 * @method static BuddingAmethyst BUDDING_AMETHYST()
 * @method static Cactus CACTUS()
 * @method static Cake CAKE()
 * @method static CakeWithCandle CAKE_WITH_CANDLE()
 * @method static CakeWithDyedCandle CAKE_WITH_DYED_CANDLE()
 * @method static Opaque CALCITE()
 * @method static Candle CANDLE()
 * @method static Carpet CARPET()
 * @method static Carrot CARROTS()
 * @method static CartographyTable CARTOGRAPHY_TABLE()
 * @method static CarvedPumpkin CARVED_PUMPKIN()
 * @method static Cauldron CAULDRON()
 * @method static CaveVines CAVE_VINES()
 * @method static Chain CHAIN()
 * @method static ChemicalHeat CHEMICAL_HEAT()
 * @method static WoodenButton CHERRY_BUTTON()
 * @method static WoodenDoor CHERRY_DOOR()
 * @method static WoodenFence CHERRY_FENCE()
 * @method static FenceGate CHERRY_FENCE_GATE()
 * @method static Leaves CHERRY_LEAVES()
 * @method static Wood CHERRY_LOG()
 * @method static Planks CHERRY_PLANKS()
 * @method static WoodenPressurePlate CHERRY_PRESSURE_PLATE()
 * @method static FloorSign CHERRY_SIGN()
 * @method static WoodenSlab CHERRY_SLAB()
 * @method static WoodenStairs CHERRY_STAIRS()
 * @method static WoodenTrapdoor CHERRY_TRAPDOOR()
 * @method static WallSign CHERRY_WALL_SIGN()
 * @method static Wood CHERRY_WOOD()
 * @method static Chest CHEST()
 * @method static ChiseledBookshelf CHISELED_BOOKSHELF()
 * @method static Opaque CHISELED_DEEPSLATE()
 * @method static Opaque CHISELED_NETHER_BRICKS()
 * @method static Opaque CHISELED_POLISHED_BLACKSTONE()
 * @method static SimplePillar CHISELED_QUARTZ()
 * @method static Opaque CHISELED_RED_SANDSTONE()
 * @method static Opaque CHISELED_SANDSTONE()
 * @method static Opaque CHISELED_STONE_BRICKS()
 * @method static ChorusFlower CHORUS_FLOWER()
 * @method static ChorusPlant CHORUS_PLANT()
 * @method static Clay CLAY()
 * @method static Coal COAL()
 * @method static CoalOre COAL_ORE()
 * @method static Opaque COBBLED_DEEPSLATE()
 * @method static Slab COBBLED_DEEPSLATE_SLAB()
 * @method static Stair COBBLED_DEEPSLATE_STAIRS()
 * @method static Wall COBBLED_DEEPSLATE_WALL()
 * @method static Opaque COBBLESTONE()
 * @method static Slab COBBLESTONE_SLAB()
 * @method static Stair COBBLESTONE_STAIRS()
 * @method static Wall COBBLESTONE_WALL()
 * @method static Cobweb COBWEB()
 * @method static CocoaBlock COCOA_POD()
 * @method static ChemistryTable COMPOUND_CREATOR()
 * @method static Concrete CONCRETE()
 * @method static ConcretePowder CONCRETE_POWDER()
 * @method static Copper COPPER()
 * @method static CopperOre COPPER_ORE()
 * @method static Coral CORAL()
 * @method static CoralBlock CORAL_BLOCK()
 * @method static FloorCoralFan CORAL_FAN()
 * @method static Flower CORNFLOWER()
 * @method static Opaque CRACKED_DEEPSLATE_BRICKS()
 * @method static Opaque CRACKED_DEEPSLATE_TILES()
 * @method static Opaque CRACKED_NETHER_BRICKS()
 * @method static Opaque CRACKED_POLISHED_BLACKSTONE_BRICKS()
 * @method static Opaque CRACKED_STONE_BRICKS()
 * @method static CraftingTable CRAFTING_TABLE()
 * @method static WoodenButton CRIMSON_BUTTON()
 * @method static WoodenDoor CRIMSON_DOOR()
 * @method static WoodenFence CRIMSON_FENCE()
 * @method static FenceGate CRIMSON_FENCE_GATE()
 * @method static Wood CRIMSON_HYPHAE()
 * @method static Planks CRIMSON_PLANKS()
 * @method static WoodenPressurePlate CRIMSON_PRESSURE_PLATE()
 * @method static NetherRoots CRIMSON_ROOTS()
 * @method static FloorSign CRIMSON_SIGN()
 * @method static WoodenSlab CRIMSON_SLAB()
 * @method static WoodenStairs CRIMSON_STAIRS()
 * @method static Wood CRIMSON_STEM()
 * @method static WoodenTrapdoor CRIMSON_TRAPDOOR()
 * @method static WallSign CRIMSON_WALL_SIGN()
 * @method static Opaque CRYING_OBSIDIAN()
 * @method static Copper CUT_COPPER()
 * @method static CopperSlab CUT_COPPER_SLAB()
 * @method static CopperStairs CUT_COPPER_STAIRS()
 * @method static Opaque CUT_RED_SANDSTONE()
 * @method static Slab CUT_RED_SANDSTONE_SLAB()
 * @method static Opaque CUT_SANDSTONE()
 * @method static Slab CUT_SANDSTONE_SLAB()
 * @method static Flower DANDELION()
 * @method static WoodenButton DARK_OAK_BUTTON()
 * @method static WoodenDoor DARK_OAK_DOOR()
 * @method static WoodenFence DARK_OAK_FENCE()
 * @method static FenceGate DARK_OAK_FENCE_GATE()
 * @method static Leaves DARK_OAK_LEAVES()
 * @method static Wood DARK_OAK_LOG()
 * @method static Planks DARK_OAK_PLANKS()
 * @method static WoodenPressurePlate DARK_OAK_PRESSURE_PLATE()
 * @method static Sapling DARK_OAK_SAPLING()
 * @method static FloorSign DARK_OAK_SIGN()
 * @method static WoodenSlab DARK_OAK_SLAB()
 * @method static WoodenStairs DARK_OAK_STAIRS()
 * @method static WoodenTrapdoor DARK_OAK_TRAPDOOR()
 * @method static WallSign DARK_OAK_WALL_SIGN()
 * @method static Wood DARK_OAK_WOOD()
 * @method static Opaque DARK_PRISMARINE()
 * @method static Slab DARK_PRISMARINE_SLAB()
 * @method static Stair DARK_PRISMARINE_STAIRS()
 * @method static DaylightSensor DAYLIGHT_SENSOR()
 * @method static DeadBush DEAD_BUSH()
 * @method static SimplePillar DEEPSLATE()
 * @method static Opaque DEEPSLATE_BRICKS()
 * @method static Slab DEEPSLATE_BRICK_SLAB()
 * @method static Stair DEEPSLATE_BRICK_STAIRS()
 * @method static Wall DEEPSLATE_BRICK_WALL()
 * @method static CoalOre DEEPSLATE_COAL_ORE()
 * @method static CopperOre DEEPSLATE_COPPER_ORE()
 * @method static DiamondOre DEEPSLATE_DIAMOND_ORE()
 * @method static EmeraldOre DEEPSLATE_EMERALD_ORE()
 * @method static GoldOre DEEPSLATE_GOLD_ORE()
 * @method static IronOre DEEPSLATE_IRON_ORE()
 * @method static LapisOre DEEPSLATE_LAPIS_LAZULI_ORE()
 * @method static RedstoneOre DEEPSLATE_REDSTONE_ORE()
 * @method static Opaque DEEPSLATE_TILES()
 * @method static Slab DEEPSLATE_TILE_SLAB()
 * @method static Stair DEEPSLATE_TILE_STAIRS()
 * @method static Wall DEEPSLATE_TILE_WALL()
 * @method static DetectorRail DETECTOR_RAIL()
 * @method static Opaque DIAMOND()
 * @method static DiamondOre DIAMOND_ORE()
 * @method static Opaque DIORITE()
 * @method static Slab DIORITE_SLAB()
 * @method static Stair DIORITE_STAIRS()
 * @method static Wall DIORITE_WALL()
 * @method static Dirt DIRT()
 * @method static DoublePitcherCrop DOUBLE_PITCHER_CROP()
 * @method static DoubleTallGrass DOUBLE_TALLGRASS()
 * @method static DragonEgg DRAGON_EGG()
 * @method static DriedKelp DRIED_KELP()
 * @method static DyedCandle DYED_CANDLE()
 * @method static DyedShulkerBox DYED_SHULKER_BOX()
 * @method static Element ELEMENT_ACTINIUM()
 * @method static Element ELEMENT_ALUMINUM()
 * @method static Element ELEMENT_AMERICIUM()
 * @method static Element ELEMENT_ANTIMONY()
 * @method static Element ELEMENT_ARGON()
 * @method static Element ELEMENT_ARSENIC()
 * @method static Element ELEMENT_ASTATINE()
 * @method static Element ELEMENT_BARIUM()
 * @method static Element ELEMENT_BERKELIUM()
 * @method static Element ELEMENT_BERYLLIUM()
 * @method static Element ELEMENT_BISMUTH()
 * @method static Element ELEMENT_BOHRIUM()
 * @method static Element ELEMENT_BORON()
 * @method static Element ELEMENT_BROMINE()
 * @method static Element ELEMENT_CADMIUM()
 * @method static Element ELEMENT_CALCIUM()
 * @method static Element ELEMENT_CALIFORNIUM()
 * @method static Element ELEMENT_CARBON()
 * @method static Element ELEMENT_CERIUM()
 * @method static Element ELEMENT_CESIUM()
 * @method static Element ELEMENT_CHLORINE()
 * @method static Element ELEMENT_CHROMIUM()
 * @method static Element ELEMENT_COBALT()
 * @method static ChemistryTable ELEMENT_CONSTRUCTOR()
 * @method static Element ELEMENT_COPERNICIUM()
 * @method static Element ELEMENT_COPPER()
 * @method static Element ELEMENT_CURIUM()
 * @method static Element ELEMENT_DARMSTADTIUM()
 * @method static Element ELEMENT_DUBNIUM()
 * @method static Element ELEMENT_DYSPROSIUM()
 * @method static Element ELEMENT_EINSTEINIUM()
 * @method static Element ELEMENT_ERBIUM()
 * @method static Element ELEMENT_EUROPIUM()
 * @method static Element ELEMENT_FERMIUM()
 * @method static Element ELEMENT_FLEROVIUM()
 * @method static Element ELEMENT_FLUORINE()
 * @method static Element ELEMENT_FRANCIUM()
 * @method static Element ELEMENT_GADOLINIUM()
 * @method static Element ELEMENT_GALLIUM()
 * @method static Element ELEMENT_GERMANIUM()
 * @method static Element ELEMENT_GOLD()
 * @method static Element ELEMENT_HAFNIUM()
 * @method static Element ELEMENT_HASSIUM()
 * @method static Element ELEMENT_HELIUM()
 * @method static Element ELEMENT_HOLMIUM()
 * @method static Element ELEMENT_HYDROGEN()
 * @method static Element ELEMENT_INDIUM()
 * @method static Element ELEMENT_IODINE()
 * @method static Element ELEMENT_IRIDIUM()
 * @method static Element ELEMENT_IRON()
 * @method static Element ELEMENT_KRYPTON()
 * @method static Element ELEMENT_LANTHANUM()
 * @method static Element ELEMENT_LAWRENCIUM()
 * @method static Element ELEMENT_LEAD()
 * @method static Element ELEMENT_LITHIUM()
 * @method static Element ELEMENT_LIVERMORIUM()
 * @method static Element ELEMENT_LUTETIUM()
 * @method static Element ELEMENT_MAGNESIUM()
 * @method static Element ELEMENT_MANGANESE()
 * @method static Element ELEMENT_MEITNERIUM()
 * @method static Element ELEMENT_MENDELEVIUM()
 * @method static Element ELEMENT_MERCURY()
 * @method static Element ELEMENT_MOLYBDENUM()
 * @method static Element ELEMENT_MOSCOVIUM()
 * @method static Element ELEMENT_NEODYMIUM()
 * @method static Element ELEMENT_NEON()
 * @method static Element ELEMENT_NEPTUNIUM()
 * @method static Element ELEMENT_NICKEL()
 * @method static Element ELEMENT_NIHONIUM()
 * @method static Element ELEMENT_NIOBIUM()
 * @method static Element ELEMENT_NITROGEN()
 * @method static Element ELEMENT_NOBELIUM()
 * @method static Element ELEMENT_OGANESSON()
 * @method static Element ELEMENT_OSMIUM()
 * @method static Element ELEMENT_OXYGEN()
 * @method static Element ELEMENT_PALLADIUM()
 * @method static Element ELEMENT_PHOSPHORUS()
 * @method static Element ELEMENT_PLATINUM()
 * @method static Element ELEMENT_PLUTONIUM()
 * @method static Element ELEMENT_POLONIUM()
 * @method static Element ELEMENT_POTASSIUM()
 * @method static Element ELEMENT_PRASEODYMIUM()
 * @method static Element ELEMENT_PROMETHIUM()
 * @method static Element ELEMENT_PROTACTINIUM()
 * @method static Element ELEMENT_RADIUM()
 * @method static Element ELEMENT_RADON()
 * @method static Element ELEMENT_RHENIUM()
 * @method static Element ELEMENT_RHODIUM()
 * @method static Element ELEMENT_ROENTGENIUM()
 * @method static Element ELEMENT_RUBIDIUM()
 * @method static Element ELEMENT_RUTHENIUM()
 * @method static Element ELEMENT_RUTHERFORDIUM()
 * @method static Element ELEMENT_SAMARIUM()
 * @method static Element ELEMENT_SCANDIUM()
 * @method static Element ELEMENT_SEABORGIUM()
 * @method static Element ELEMENT_SELENIUM()
 * @method static Element ELEMENT_SILICON()
 * @method static Element ELEMENT_SILVER()
 * @method static Element ELEMENT_SODIUM()
 * @method static Element ELEMENT_STRONTIUM()
 * @method static Element ELEMENT_SULFUR()
 * @method static Element ELEMENT_TANTALUM()
 * @method static Element ELEMENT_TECHNETIUM()
 * @method static Element ELEMENT_TELLURIUM()
 * @method static Element ELEMENT_TENNESSINE()
 * @method static Element ELEMENT_TERBIUM()
 * @method static Element ELEMENT_THALLIUM()
 * @method static Element ELEMENT_THORIUM()
 * @method static Element ELEMENT_THULIUM()
 * @method static Element ELEMENT_TIN()
 * @method static Element ELEMENT_TITANIUM()
 * @method static Element ELEMENT_TUNGSTEN()
 * @method static Element ELEMENT_URANIUM()
 * @method static Element ELEMENT_VANADIUM()
 * @method static Element ELEMENT_XENON()
 * @method static Element ELEMENT_YTTERBIUM()
 * @method static Element ELEMENT_YTTRIUM()
 * @method static Opaque ELEMENT_ZERO()
 * @method static Element ELEMENT_ZINC()
 * @method static Element ELEMENT_ZIRCONIUM()
 * @method static Opaque EMERALD()
 * @method static EmeraldOre EMERALD_ORE()
 * @method static EnchantingTable ENCHANTING_TABLE()
 * @method static EnderChest ENDER_CHEST()
 * @method static EndPortalFrame END_PORTAL_FRAME()
 * @method static EndRod END_ROD()
 * @method static Opaque END_STONE()
 * @method static Opaque END_STONE_BRICKS()
 * @method static Slab END_STONE_BRICK_SLAB()
 * @method static Stair END_STONE_BRICK_STAIRS()
 * @method static Wall END_STONE_BRICK_WALL()
 * @method static Slab FAKE_WOODEN_SLAB()
 * @method static Farmland FARMLAND()
 * @method static TallGrass FERN()
 * @method static Fire FIRE()
 * @method static FletchingTable FLETCHING_TABLE()
 * @method static Leaves FLOWERING_AZALEA_LEAVES()
 * @method static FlowerPot FLOWER_POT()
 * @method static Froglight FROGLIGHT()
 * @method static FrostedIce FROSTED_ICE()
 * @method static Furnace FURNACE()
 * @method static GildedBlackstone GILDED_BLACKSTONE()
 * @method static Glass GLASS()
 * @method static GlassPane GLASS_PANE()
 * @method static GlazedTerracotta GLAZED_TERRACOTTA()
 * @method static ItemFrame GLOWING_ITEM_FRAME()
 * @method static GlowingObsidian GLOWING_OBSIDIAN()
 * @method static Glowstone GLOWSTONE()
 * @method static GlowLichen GLOW_LICHEN()
 * @method static Opaque GOLD()
 * @method static GoldOre GOLD_ORE()
 * @method static Opaque GRANITE()
 * @method static Slab GRANITE_SLAB()
 * @method static Stair GRANITE_STAIRS()
 * @method static Wall GRANITE_WALL()
 * @method static Grass GRASS()
 * @method static GrassPath GRASS_PATH()
 * @method static Gravel GRAVEL()
 * @method static Torch GREEN_TORCH()
 * @method static HangingRoots HANGING_ROOTS()
 * @method static HardenedClay HARDENED_CLAY()
 * @method static HardenedGlass HARDENED_GLASS()
 * @method static HardenedGlassPane HARDENED_GLASS_PANE()
 * @method static HayBale HAY_BALE()
 * @method static Opaque HONEYCOMB()
 * @method static Hopper HOPPER()
 * @method static Ice ICE()
 * @method static InfestedStone INFESTED_CHISELED_STONE_BRICK()
 * @method static InfestedStone INFESTED_COBBLESTONE()
 * @method static InfestedStone INFESTED_CRACKED_STONE_BRICK()
 * @method static InfestedStone INFESTED_MOSSY_STONE_BRICK()
 * @method static InfestedStone INFESTED_STONE()
 * @method static InfestedStone INFESTED_STONE_BRICK()
 * @method static Opaque INFO_UPDATE()
 * @method static Opaque INFO_UPDATE2()
 * @method static Transparent INVISIBLE_BEDROCK()
 * @method static Opaque IRON()
 * @method static Thin IRON_BARS()
 * @method static Door IRON_DOOR()
 * @method static IronOre IRON_ORE()
 * @method static Trapdoor IRON_TRAPDOOR()
 * @method static ItemFrame ITEM_FRAME()
 * @method static Jukebox JUKEBOX()
 * @method static WoodenButton JUNGLE_BUTTON()
 * @method static WoodenDoor JUNGLE_DOOR()
 * @method static WoodenFence JUNGLE_FENCE()
 * @method static FenceGate JUNGLE_FENCE_GATE()
 * @method static Leaves JUNGLE_LEAVES()
 * @method static Wood JUNGLE_LOG()
 * @method static Planks JUNGLE_PLANKS()
 * @method static WoodenPressurePlate JUNGLE_PRESSURE_PLATE()
 * @method static Sapling JUNGLE_SAPLING()
 * @method static FloorSign JUNGLE_SIGN()
 * @method static WoodenSlab JUNGLE_SLAB()
 * @method static WoodenStairs JUNGLE_STAIRS()
 * @method static WoodenTrapdoor JUNGLE_TRAPDOOR()
 * @method static WallSign JUNGLE_WALL_SIGN()
 * @method static Wood JUNGLE_WOOD()
 * @method static ChemistryTable LAB_TABLE()
 * @method static Ladder LADDER()
 * @method static Lantern LANTERN()
 * @method static Opaque LAPIS_LAZULI()
 * @method static LapisOre LAPIS_LAZULI_ORE()
 * @method static DoubleTallGrass LARGE_FERN()
 * @method static Lava LAVA()
 * @method static LavaCauldron LAVA_CAULDRON()
 * @method static Lectern LECTERN()
 * @method static Opaque LEGACY_STONECUTTER()
 * @method static Lever LEVER()
 * @method static Light LIGHT()
 * @method static LightningRod LIGHTNING_ROD()
 * @method static DoublePlant LILAC()
 * @method static Flower LILY_OF_THE_VALLEY()
 * @method static WaterLily LILY_PAD()
 * @method static LitPumpkin LIT_PUMPKIN()
 * @method static Loom LOOM()
 * @method static Magma MAGMA()
 * @method static WoodenButton MANGROVE_BUTTON()
 * @method static WoodenDoor MANGROVE_DOOR()
 * @method static WoodenFence MANGROVE_FENCE()
 * @method static FenceGate MANGROVE_FENCE_GATE()
 * @method static Leaves MANGROVE_LEAVES()
 * @method static Wood MANGROVE_LOG()
 * @method static Planks MANGROVE_PLANKS()
 * @method static WoodenPressurePlate MANGROVE_PRESSURE_PLATE()
 * @method static MangroveRoots MANGROVE_ROOTS()
 * @method static FloorSign MANGROVE_SIGN()
 * @method static WoodenSlab MANGROVE_SLAB()
 * @method static WoodenStairs MANGROVE_STAIRS()
 * @method static WoodenTrapdoor MANGROVE_TRAPDOOR()
 * @method static WallSign MANGROVE_WALL_SIGN()
 * @method static Wood MANGROVE_WOOD()
 * @method static ChemistryTable MATERIAL_REDUCER()
 * @method static Melon MELON()
 * @method static MelonStem MELON_STEM()
 * @method static MobHead MOB_HEAD()
 * @method static MonsterSpawner MONSTER_SPAWNER()
 * @method static Opaque MOSSY_COBBLESTONE()
 * @method static Slab MOSSY_COBBLESTONE_SLAB()
 * @method static Stair MOSSY_COBBLESTONE_STAIRS()
 * @method static Wall MOSSY_COBBLESTONE_WALL()
 * @method static Opaque MOSSY_STONE_BRICKS()
 * @method static Slab MOSSY_STONE_BRICK_SLAB()
 * @method static Stair MOSSY_STONE_BRICK_STAIRS()
 * @method static Wall MOSSY_STONE_BRICK_WALL()
 * @method static Opaque MUD()
 * @method static SimplePillar MUDDY_MANGROVE_ROOTS()
 * @method static Opaque MUD_BRICKS()
 * @method static Slab MUD_BRICK_SLAB()
 * @method static Stair MUD_BRICK_STAIRS()
 * @method static Wall MUD_BRICK_WALL()
 * @method static MushroomStem MUSHROOM_STEM()
 * @method static Mycelium MYCELIUM()
 * @method static Opaque NETHERITE()
 * @method static Netherrack NETHERRACK()
 * @method static Opaque NETHER_BRICKS()
 * @method static Fence NETHER_BRICK_FENCE()
 * @method static Slab NETHER_BRICK_SLAB()
 * @method static Stair NETHER_BRICK_STAIRS()
 * @method static Wall NETHER_BRICK_WALL()
 * @method static NetherGoldOre NETHER_GOLD_ORE()
 * @method static NetherPortal NETHER_PORTAL()
 * @method static NetherQuartzOre NETHER_QUARTZ_ORE()
 * @method static NetherReactor NETHER_REACTOR_CORE()
 * @method static NetherWartPlant NETHER_WART()
 * @method static Opaque NETHER_WART_BLOCK()
 * @method static Note NOTE_BLOCK()
 * @method static WoodenButton OAK_BUTTON()
 * @method static WoodenDoor OAK_DOOR()
 * @method static WoodenFence OAK_FENCE()
 * @method static FenceGate OAK_FENCE_GATE()
 * @method static Leaves OAK_LEAVES()
 * @method static Wood OAK_LOG()
 * @method static Planks OAK_PLANKS()
 * @method static WoodenPressurePlate OAK_PRESSURE_PLATE()
 * @method static Sapling OAK_SAPLING()
 * @method static FloorSign OAK_SIGN()
 * @method static WoodenSlab OAK_SLAB()
 * @method static WoodenStairs OAK_STAIRS()
 * @method static WoodenTrapdoor OAK_TRAPDOOR()
 * @method static WallSign OAK_WALL_SIGN()
 * @method static Wood OAK_WOOD()
 * @method static Opaque OBSIDIAN()
 * @method static Flower ORANGE_TULIP()
 * @method static Flower OXEYE_DAISY()
 * @method static PackedIce PACKED_ICE()
 * @method static Opaque PACKED_MUD()
 * @method static DoublePlant PEONY()
 * @method static PinkPetals PINK_PETALS()
 * @method static Flower PINK_TULIP()
 * @method static PitcherCrop PITCHER_CROP()
 * @method static DoublePlant PITCHER_PLANT()
 * @method static Podzol PODZOL()
 * @method static Opaque POLISHED_ANDESITE()
 * @method static Slab POLISHED_ANDESITE_SLAB()
 * @method static Stair POLISHED_ANDESITE_STAIRS()
 * @method static SimplePillar POLISHED_BASALT()
 * @method static Opaque POLISHED_BLACKSTONE()
 * @method static Opaque POLISHED_BLACKSTONE_BRICKS()
 * @method static Slab POLISHED_BLACKSTONE_BRICK_SLAB()
 * @method static Stair POLISHED_BLACKSTONE_BRICK_STAIRS()
 * @method static Wall POLISHED_BLACKSTONE_BRICK_WALL()
 * @method static StoneButton POLISHED_BLACKSTONE_BUTTON()
 * @method static StonePressurePlate POLISHED_BLACKSTONE_PRESSURE_PLATE()
 * @method static Slab POLISHED_BLACKSTONE_SLAB()
 * @method static Stair POLISHED_BLACKSTONE_STAIRS()
 * @method static Wall POLISHED_BLACKSTONE_WALL()
 * @method static Opaque POLISHED_DEEPSLATE()
 * @method static Slab POLISHED_DEEPSLATE_SLAB()
 * @method static Stair POLISHED_DEEPSLATE_STAIRS()
 * @method static Wall POLISHED_DEEPSLATE_WALL()
 * @method static Opaque POLISHED_DIORITE()
 * @method static Slab POLISHED_DIORITE_SLAB()
 * @method static Stair POLISHED_DIORITE_STAIRS()
 * @method static Opaque POLISHED_GRANITE()
 * @method static Slab POLISHED_GRANITE_SLAB()
 * @method static Stair POLISHED_GRANITE_STAIRS()
 * @method static Flower POPPY()
 * @method static Potato POTATOES()
 * @method static PotionCauldron POTION_CAULDRON()
 * @method static PoweredRail POWERED_RAIL()
 * @method static Opaque PRISMARINE()
 * @method static Opaque PRISMARINE_BRICKS()
 * @method static Slab PRISMARINE_BRICKS_SLAB()
 * @method static Stair PRISMARINE_BRICKS_STAIRS()
 * @method static Slab PRISMARINE_SLAB()
 * @method static Stair PRISMARINE_STAIRS()
 * @method static Wall PRISMARINE_WALL()
 * @method static Pumpkin PUMPKIN()
 * @method static PumpkinStem PUMPKIN_STEM()
 * @method static Torch PURPLE_TORCH()
 * @method static Opaque PURPUR()
 * @method static SimplePillar PURPUR_PILLAR()
 * @method static Slab PURPUR_SLAB()
 * @method static Stair PURPUR_STAIRS()
 * @method static Opaque QUARTZ()
 * @method static Opaque QUARTZ_BRICKS()
 * @method static SimplePillar QUARTZ_PILLAR()
 * @method static Slab QUARTZ_SLAB()
 * @method static Stair QUARTZ_STAIRS()
 * @method static Rail RAIL()
 * @method static Opaque RAW_COPPER()
 * @method static Opaque RAW_GOLD()
 * @method static Opaque RAW_IRON()
 * @method static Redstone REDSTONE()
 * @method static RedstoneComparator REDSTONE_COMPARATOR()
 * @method static RedstoneLamp REDSTONE_LAMP()
 * @method static RedstoneOre REDSTONE_ORE()
 * @method static RedstoneRepeater REDSTONE_REPEATER()
 * @method static RedstoneTorch REDSTONE_TORCH()
 * @method static RedstoneWire REDSTONE_WIRE()
 * @method static RedMushroom RED_MUSHROOM()
 * @method static RedMushroomBlock RED_MUSHROOM_BLOCK()
 * @method static Opaque RED_NETHER_BRICKS()
 * @method static Slab RED_NETHER_BRICK_SLAB()
 * @method static Stair RED_NETHER_BRICK_STAIRS()
 * @method static Wall RED_NETHER_BRICK_WALL()
 * @method static Sand RED_SAND()
 * @method static Opaque RED_SANDSTONE()
 * @method static Slab RED_SANDSTONE_SLAB()
 * @method static Stair RED_SANDSTONE_STAIRS()
 * @method static Wall RED_SANDSTONE_WALL()
 * @method static Torch RED_TORCH()
 * @method static Flower RED_TULIP()
 * @method static Opaque REINFORCED_DEEPSLATE()
 * @method static Reserved6 RESERVED6()
 * @method static DoublePlant ROSE_BUSH()
 * @method static Sand SAND()
 * @method static Opaque SANDSTONE()
 * @method static Slab SANDSTONE_SLAB()
 * @method static Stair SANDSTONE_STAIRS()
 * @method static Wall SANDSTONE_WALL()
 * @method static Sculk SCULK()
 * @method static SeaLantern SEA_LANTERN()
 * @method static SeaPickle SEA_PICKLE()
 * @method static Opaque SHROOMLIGHT()
 * @method static ShulkerBox SHULKER_BOX()
 * @method static Slime SLIME()
 * @method static SmallDripleaf SMALL_DRIPLEAF()
 * @method static SmithingTable SMITHING_TABLE()
 * @method static Furnace SMOKER()
 * @method static Opaque SMOOTH_BASALT()
 * @method static Opaque SMOOTH_QUARTZ()
 * @method static Slab SMOOTH_QUARTZ_SLAB()
 * @method static Stair SMOOTH_QUARTZ_STAIRS()
 * @method static Opaque SMOOTH_RED_SANDSTONE()
 * @method static Slab SMOOTH_RED_SANDSTONE_SLAB()
 * @method static Stair SMOOTH_RED_SANDSTONE_STAIRS()
 * @method static Opaque SMOOTH_SANDSTONE()
 * @method static Slab SMOOTH_SANDSTONE_SLAB()
 * @method static Stair SMOOTH_SANDSTONE_STAIRS()
 * @method static Opaque SMOOTH_STONE()
 * @method static Slab SMOOTH_STONE_SLAB()
 * @method static Snow SNOW()
 * @method static SnowLayer SNOW_LAYER()
 * @method static SoulFire SOUL_FIRE()
 * @method static Lantern SOUL_LANTERN()
 * @method static SoulSand SOUL_SAND()
 * @method static Opaque SOUL_SOIL()
 * @method static Torch SOUL_TORCH()
 * @method static Sponge SPONGE()
 * @method static SporeBlossom SPORE_BLOSSOM()
 * @method static WoodenButton SPRUCE_BUTTON()
 * @method static WoodenDoor SPRUCE_DOOR()
 * @method static WoodenFence SPRUCE_FENCE()
 * @method static FenceGate SPRUCE_FENCE_GATE()
 * @method static Leaves SPRUCE_LEAVES()
 * @method static Wood SPRUCE_LOG()
 * @method static Planks SPRUCE_PLANKS()
 * @method static WoodenPressurePlate SPRUCE_PRESSURE_PLATE()
 * @method static Sapling SPRUCE_SAPLING()
 * @method static FloorSign SPRUCE_SIGN()
 * @method static WoodenSlab SPRUCE_SLAB()
 * @method static WoodenStairs SPRUCE_STAIRS()
 * @method static WoodenTrapdoor SPRUCE_TRAPDOOR()
 * @method static WallSign SPRUCE_WALL_SIGN()
 * @method static Wood SPRUCE_WOOD()
 * @method static StainedHardenedClay STAINED_CLAY()
 * @method static StainedGlass STAINED_GLASS()
 * @method static StainedGlassPane STAINED_GLASS_PANE()
 * @method static StainedHardenedGlass STAINED_HARDENED_GLASS()
 * @method static StainedHardenedGlassPane STAINED_HARDENED_GLASS_PANE()
 * @method static Opaque STONE()
 * @method static Stonecutter STONECUTTER()
 * @method static Opaque STONE_BRICKS()
 * @method static Slab STONE_BRICK_SLAB()
 * @method static Stair STONE_BRICK_STAIRS()
 * @method static Wall STONE_BRICK_WALL()
 * @method static StoneButton STONE_BUTTON()
 * @method static StonePressurePlate STONE_PRESSURE_PLATE()
 * @method static Slab STONE_SLAB()
 * @method static Stair STONE_STAIRS()
 * @method static Sugarcane SUGARCANE()
 * @method static DoublePlant SUNFLOWER()
 * @method static SweetBerryBush SWEET_BERRY_BUSH()
 * @method static TallGrass TALL_GRASS()
 * @method static TintedGlass TINTED_GLASS()
 * @method static TNT TNT()
 * @method static Torch TORCH()
 * @method static Flower TORCHFLOWER()
 * @method static TorchflowerCrop TORCHFLOWER_CROP()
 * @method static TrappedChest TRAPPED_CHEST()
 * @method static Tripwire TRIPWIRE()
 * @method static TripwireHook TRIPWIRE_HOOK()
 * @method static Opaque TUFF()
 * @method static NetherVines TWISTING_VINES()
 * @method static UnderwaterTorch UNDERWATER_TORCH()
 * @method static Vine VINES()
 * @method static WallBanner WALL_BANNER()
 * @method static WallCoralFan WALL_CORAL_FAN()
 * @method static WoodenButton WARPED_BUTTON()
 * @method static WoodenDoor WARPED_DOOR()
 * @method static WoodenFence WARPED_FENCE()
 * @method static FenceGate WARPED_FENCE_GATE()
 * @method static Wood WARPED_HYPHAE()
 * @method static Planks WARPED_PLANKS()
 * @method static WoodenPressurePlate WARPED_PRESSURE_PLATE()
 * @method static NetherRoots WARPED_ROOTS()
 * @method static FloorSign WARPED_SIGN()
 * @method static WoodenSlab WARPED_SLAB()
 * @method static WoodenStairs WARPED_STAIRS()
 * @method static Wood WARPED_STEM()
 * @method static WoodenTrapdoor WARPED_TRAPDOOR()
 * @method static WallSign WARPED_WALL_SIGN()
 * @method static Opaque WARPED_WART_BLOCK()
 * @method static Water WATER()
 * @method static WaterCauldron WATER_CAULDRON()
 * @method static NetherVines WEEPING_VINES()
 * @method static WeightedPressurePlateHeavy WEIGHTED_PRESSURE_PLATE_HEAVY()
 * @method static WeightedPressurePlateLight WEIGHTED_PRESSURE_PLATE_LIGHT()
 * @method static Wheat WHEAT()
 * @method static Flower WHITE_TULIP()
 * @method static WitherRose WITHER_ROSE()
 * @method static Wool WOOL()
 */
final class VanillaBlocks{
	use CloningRegistryTrait;

	private function __construct(){
		//NOOP
	}

	/**
	 * @phpstan-template TBlock of Block
	 * @phpstan-param \Closure(int) : TBlock $createBlock
	 * @phpstan-return TBlock
	 */
	protected static function register(string $name, \Closure $createBlock) : Block{
		//this sketchy hack allows us to avoid manually writing the constants inline
		//since type IDs are generated from this class anyway, I'm OK with this hack
		//nonetheless, we should try to get rid of it in a future major version (e.g by using string type IDs)
		$reflect = new \ReflectionClass(BlockTypeIds::class);
		$typeId = $reflect->getConstant(mb_strtoupper($name));
		if(!is_int($typeId)){
			//this allows registering new stuff without adding new type ID constants
			//this reduces the number of mandatory steps to test new features in local development
			\GlobalLogger::get()->error(self::class . ": No constant type ID found for $name, generating a new one");
			$typeId = BlockTypeIds::newId();
		}
		$block = $createBlock($typeId);
		self::_registryRegister($name, $block);

		return $block;
	}

	/**
	 * @return Block[]
	 * @phpstan-return array<string, Block>
	 */
	public static function getAll() : array{
		//phpstan doesn't support generic traits yet :(
		/** @var Block[] $result */
		$result = self::_registryGetAll();
		return $result;
	}

	protected static function setup() : void{
		self::register("air", fn(int $id) => new Air(new BID($id), "Air", new Info(BreakInfo::indestructible(-1.0))));

		$railBreakInfo = new Info(new BreakInfo(0.7));
		self::register("activator_rail", fn(int $id) => new ActivatorRail(new BID($id), "Activator Rail", $railBreakInfo));
		self::register("anvil", fn(int $id) => new Anvil(new BID($id), "Anvil", new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD, 6000.0))));
		self::register("bamboo", fn(int $id) => new Bamboo(new BID($id), "Bamboo", new Info(new class(2.0 /* 1.0 in PC */, ToolType::AXE) extends BreakInfo{
			public function getBreakTime(Item $item) : float{
				if($item->getBlockToolType() === ToolType::SWORD){
					return 0.0;
				}
				return parent::getBreakTime($item);
			}
		}, [Tags::POTTABLE_PLANTS])));
		self::register("bamboo_sapling", fn(int $id) => new BambooSapling(new BID($id), "Bamboo Sapling", new Info(BreakInfo::instant())));

		$bannerBreakInfo = new Info(BreakInfo::axe(1.0));
		self::register("banner", fn(int $id) => new FloorBanner(new BID($id, TileBanner::class), "Banner", $bannerBreakInfo));
		self::register("wall_banner", fn(int $id) => new WallBanner(new BID($id, TileBanner::class), "Wall Banner", $bannerBreakInfo));
		self::register("barrel", fn(int $id) => new Barrel(new BID($id, TileBarrel::class), "Barrel", new Info(BreakInfo::axe(2.5))));
		self::register("barrier", fn(int $id) => new Transparent(new BID($id), "Barrier", new Info(BreakInfo::indestructible())));
		self::register("beacon", fn(int $id) => new Beacon(new BID($id, TileBeacon::class), "Beacon", new Info(new BreakInfo(3.0))));
		self::register("bed", fn(int $id) => new Bed(new BID($id, TileBed::class), "Bed Block", new Info(new BreakInfo(0.2))));
		self::register("bedrock", fn(int $id) => new Bedrock(new BID($id), "Bedrock", new Info(BreakInfo::indestructible())));

		self::register("beetroots", fn(int $id) => new Beetroot(new BID($id), "Beetroot Block", new Info(BreakInfo::instant())));
		self::register("bell", fn(int $id) => new Bell(new BID($id, TileBell::class), "Bell", new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD))));
		self::register("blue_ice", fn(int $id) => new BlueIce(new BID($id), "Blue Ice", new Info(BreakInfo::pickaxe(2.8))));
		self::register("bone_block", fn(int $id) => new BoneBlock(new BID($id), "Bone Block", new Info(BreakInfo::pickaxe(2.0, ToolTier::WOOD))));
		self::register("bookshelf", fn(int $id) => new Bookshelf(new BID($id), "Bookshelf", new Info(BreakInfo::axe(1.5))));
		self::register("chiseled_bookshelf", fn(int $id) => new ChiseledBookshelf(new BID($id, TileChiseledBookshelf::class), "Chiseled Bookshelf", new Info(BreakInfo::axe(1.5))));
		self::register("brewing_stand", fn(int $id) => new BrewingStand(new BID($id, TileBrewingStand::class), "Brewing Stand", new Info(BreakInfo::pickaxe(0.5, ToolTier::WOOD))));

		$bricksBreakInfo = new Info(BreakInfo::pickaxe(2.0, ToolTier::WOOD, 30.0));
		self::register("brick_stairs", fn(int $id) => new Stair(new BID($id), "Brick Stairs", $bricksBreakInfo));
		self::register("bricks", fn(int $id) => new Opaque(new BID($id), "Bricks", $bricksBreakInfo));

		self::register("brown_mushroom", fn(int $id) => new BrownMushroom(new BID($id), "Brown Mushroom", new Info(BreakInfo::instant(), [Tags::POTTABLE_PLANTS])));
		self::register("cactus", fn(int $id) => new Cactus(new BID($id), "Cactus", new Info(new BreakInfo(0.4), [Tags::POTTABLE_PLANTS])));
		self::register("cake", fn(int $id) => new Cake(new BID($id), "Cake", new Info(new BreakInfo(0.5))));
		self::register("carrots", fn(int $id) => new Carrot(new BID($id), "Carrot Block", new Info(BreakInfo::instant())));

		$chestBreakInfo = new Info(BreakInfo::axe(2.5));
		self::register("chest", fn(int $id) => new Chest(new BID($id, TileChest::class), "Chest", $chestBreakInfo));
		self::register("clay", fn(int $id) => new Clay(new BID($id), "Clay Block", new Info(BreakInfo::shovel(0.6))));
		self::register("coal", fn(int $id) => new Coal(new BID($id), "Coal Block", new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD, 30.0))));

		$cobblestoneBreakInfo = new Info(BreakInfo::pickaxe(2.0, ToolTier::WOOD, 30.0));
		$cobblestone = self::register("cobblestone", fn(int $id) => new Opaque(new BID($id), "Cobblestone", $cobblestoneBreakInfo));
		self::register("mossy_cobblestone", fn(int $id) => new Opaque(new BID($id), "Mossy Cobblestone", $cobblestoneBreakInfo));
		self::register("cobblestone_stairs", fn(int $id) => new Stair(new BID($id), "Cobblestone Stairs", $cobblestoneBreakInfo));
		self::register("mossy_cobblestone_stairs", fn(int $id) => new Stair(new BID($id), "Mossy Cobblestone Stairs", $cobblestoneBreakInfo));

		self::register("cobweb", fn(int $id) => new Cobweb(new BID($id), "Cobweb", new Info(new BreakInfo(4.0, ToolType::SWORD | ToolType::SHEARS, 1))));
		self::register("cocoa_pod", fn(int $id) => new CocoaBlock(new BID($id), "Cocoa Block", new Info(BreakInfo::axe(0.2, null, 15.0))));
		self::register("coral_block", fn(int $id) => new CoralBlock(new BID($id), "Coral Block", new Info(BreakInfo::pickaxe(7.0, ToolTier::WOOD))));
		self::register("daylight_sensor", fn(int $id) => new DaylightSensor(new BID($id, TileDaylightSensor::class), "Daylight Sensor", new Info(BreakInfo::axe(0.2))));
		self::register("dead_bush", fn(int $id) => new DeadBush(new BID($id), "Dead Bush", new Info(BreakInfo::instant(ToolType::SHEARS, 1), [Tags::POTTABLE_PLANTS])));
		self::register("detector_rail", fn(int $id) => new DetectorRail(new BID($id), "Detector Rail", $railBreakInfo));

		self::register("diamond", fn(int $id) => new Opaque(new BID($id), "Diamond Block", new Info(BreakInfo::pickaxe(5.0, ToolTier::IRON, 30.0))));
		self::register("dirt", fn(int $id) => new Dirt(new BID($id), "Dirt", new Info(BreakInfo::shovel(0.5), [Tags::DIRT])));
		self::register("sunflower", fn(int $id) => new DoublePlant(new BID($id), "Sunflower", new Info(BreakInfo::instant())));
		self::register("lilac", fn(int $id) => new DoublePlant(new BID($id), "Lilac", new Info(BreakInfo::instant())));
		self::register("rose_bush", fn(int $id) => new DoublePlant(new BID($id), "Rose Bush", new Info(BreakInfo::instant())));
		self::register("peony", fn(int $id) => new DoublePlant(new BID($id), "Peony", new Info(BreakInfo::instant())));
		self::register("pink_petals", fn(int $id) => new PinkPetals(new BID($id), "Pink Petals", new Info(BreakInfo::instant())));
		self::register("double_tallgrass", fn(int $id) => new DoubleTallGrass(new BID($id), "Double Tallgrass", new Info(BreakInfo::instant(ToolType::SHEARS, 1))));
		self::register("large_fern", fn(int $id) => new DoubleTallGrass(new BID($id), "Large Fern", new Info(BreakInfo::instant(ToolType::SHEARS, 1))));
		self::register("pitcher_plant", fn(int $id) => new DoublePlant(new BID($id), "Pitcher Plant", new Info(BreakInfo::instant())));
		self::register("pitcher_crop", fn(int $id) => new PitcherCrop(new BID($id), "Pitcher Crop", new Info(BreakInfo::instant())));
		self::register("double_pitcher_crop", fn(int $id) => new DoublePitcherCrop(new BID($id), "Double Pitcher Crop", new Info(BreakInfo::instant())));
		self::register("dragon_egg", fn(int $id) => new DragonEgg(new BID($id), "Dragon Egg", new Info(BreakInfo::pickaxe(3.0, ToolTier::WOOD))));
		self::register("dried_kelp", fn(int $id) => new DriedKelp(new BID($id), "Dried Kelp Block", new Info(new BreakInfo(0.5, ToolType::NONE, 0, 12.5))));
		self::register("emerald", fn(int $id) => new Opaque(new BID($id), "Emerald Block", new Info(BreakInfo::pickaxe(5.0, ToolTier::IRON, 30.0))));
		self::register("enchanting_table", fn(int $id) => new EnchantingTable(new BID($id, TileEnchantingTable::class), "Enchanting Table", new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD, 6000.0))));
		self::register("end_portal_frame", fn(int $id) => new EndPortalFrame(new BID($id), "End Portal Frame", new Info(BreakInfo::indestructible())));
		self::register("end_rod", fn(int $id) => new EndRod(new BID($id), "End Rod", new Info(BreakInfo::instant())));
		self::register("end_stone", fn(int $id) => new Opaque(new BID($id), "End Stone", new Info(BreakInfo::pickaxe(3.0, ToolTier::WOOD, 45.0))));

		$endBrickBreakInfo = new Info(BreakInfo::pickaxe(0.8, ToolTier::WOOD, 4.0));
		self::register("end_stone_bricks", fn(int $id) => new Opaque(new BID($id), "End Stone Bricks", $endBrickBreakInfo));
		self::register("end_stone_brick_stairs", fn(int $id) => new Stair(new BID($id), "End Stone Brick Stairs", $endBrickBreakInfo));

		self::register("ender_chest", fn(int $id) => new EnderChest(new BID($id, TileEnderChest::class), "Ender Chest", new Info(BreakInfo::pickaxe(22.5, ToolTier::WOOD, 3000.0))));
		self::register("farmland", fn(int $id) => new Farmland(new BID($id), "Farmland", new Info(BreakInfo::shovel(0.6), [Tags::DIRT])));
		self::register("fire", fn(int $id) => new Fire(new BID($id), "Fire Block", new Info(BreakInfo::instant(), [Tags::FIRE])));

		$flowerTypeInfo = new Info(BreakInfo::instant(), [Tags::POTTABLE_PLANTS]);
		self::register("dandelion", fn(int $id) => new Flower(new BID($id), "Dandelion", $flowerTypeInfo));
		self::register("poppy", fn(int $id) => new Flower(new BID($id), "Poppy", $flowerTypeInfo));
		self::register("allium", fn(int $id) => new Flower(new BID($id), "Allium", $flowerTypeInfo));
		self::register("azure_bluet", fn(int $id) => new Flower(new BID($id), "Azure Bluet", $flowerTypeInfo));
		self::register("blue_orchid", fn(int $id) => new Flower(new BID($id), "Blue Orchid", $flowerTypeInfo));
		self::register("cornflower", fn(int $id) => new Flower(new BID($id), "Cornflower", $flowerTypeInfo));
		self::register("lily_of_the_valley", fn(int $id) => new Flower(new BID($id), "Lily of the Valley", $flowerTypeInfo));
		self::register("orange_tulip", fn(int $id) => new Flower(new BID($id), "Orange Tulip", $flowerTypeInfo));
		self::register("oxeye_daisy", fn(int $id) => new Flower(new BID($id), "Oxeye Daisy", $flowerTypeInfo));
		self::register("pink_tulip", fn(int $id) => new Flower(new BID($id), "Pink Tulip", $flowerTypeInfo));
		self::register("red_tulip", fn(int $id) => new Flower(new BID($id), "Red Tulip", $flowerTypeInfo));
		self::register("white_tulip", fn(int $id) => new Flower(new BID($id), "White Tulip", $flowerTypeInfo));
		self::register("torchflower", fn(int $id) => new Flower(new BID($id), "Torchflower", $flowerTypeInfo));
		self::register("torchflower_crop", fn(int $id) => new TorchflowerCrop(new BID($id), "Torchflower Crop", new Info(BreakInfo::instant())));
		self::register("flower_pot", fn(int $id) => new FlowerPot(new BID($id, TileFlowerPot::class), "Flower Pot", new Info(BreakInfo::instant())));
		self::register("frosted_ice", fn(int $id) => new FrostedIce(new BID($id), "Frosted Ice", new Info(BreakInfo::pickaxe(2.5))));
		self::register("furnace", fn(int $id) => new Furnace(new BID($id, TileNormalFurnace::class), "Furnace", new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD)), FurnaceType::FURNACE));
		self::register("blast_furnace", fn(int $id) => new Furnace(new BID($id, TileBlastFurnace::class), "Blast Furnace", new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD)), FurnaceType::BLAST_FURNACE));
		self::register("smoker", fn(int $id) => new Furnace(new BID($id, TileSmoker::class), "Smoker", new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD)), FurnaceType::SMOKER));

		$glassBreakInfo = new Info(new BreakInfo(0.3));
		self::register("glass", fn(int $id) => new Glass(new BID($id), "Glass", $glassBreakInfo));
		self::register("glass_pane", fn(int $id) => new GlassPane(new BID($id), "Glass Pane", $glassBreakInfo));
		self::register("glowing_obsidian", fn(int $id) => new GlowingObsidian(new BID($id), "Glowing Obsidian", new Info(BreakInfo::pickaxe(10.0, ToolTier::DIAMOND, 50.0))));
		self::register("glowstone", fn(int $id) => new Glowstone(new BID($id), "Glowstone", new Info(BreakInfo::pickaxe(0.3))));
		self::register("glow_lichen", fn(int $id) => new GlowLichen(new BID($id), "Glow Lichen", new Info(BreakInfo::axe(0.2, null, 0.2))));
		self::register("gold", fn(int $id) => new Opaque(new BID($id), "Gold Block", new Info(BreakInfo::pickaxe(3.0, ToolTier::IRON, 30.0))));

		$grassBreakInfo = BreakInfo::shovel(0.6);
		self::register("grass", fn(int $id) => new Grass(new BID($id), "Grass", new Info($grassBreakInfo, [Tags::DIRT])));
		self::register("grass_path", fn(int $id) => new GrassPath(new BID($id), "Grass Path", new Info($grassBreakInfo)));
		self::register("gravel", fn(int $id) => new Gravel(new BID($id), "Gravel", new Info(BreakInfo::shovel(0.6))));

		$hardenedClayBreakInfo = new Info(BreakInfo::pickaxe(1.25, ToolTier::WOOD, 21.0));
		self::register("hardened_clay", fn(int $id) => new HardenedClay(new BID($id), "Hardened Clay", $hardenedClayBreakInfo));

		$hardenedGlassBreakInfo = new Info(new BreakInfo(10.0));
		self::register("hardened_glass", fn(int $id) => new HardenedGlass(new BID($id), "Hardened Glass", $hardenedGlassBreakInfo));
		self::register("hardened_glass_pane", fn(int $id) => new HardenedGlassPane(new BID($id), "Hardened Glass Pane", $hardenedGlassBreakInfo));
		self::register("hay_bale", fn(int $id) => new HayBale(new BID($id), "Hay Bale", new Info(new BreakInfo(0.5))));
		self::register("hopper", fn(int $id) => new Hopper(new BID($id, TileHopper::class), "Hopper", new Info(BreakInfo::pickaxe(3.0, ToolTier::WOOD, 15.0))));
		self::register("ice", fn(int $id) => new Ice(new BID($id), "Ice", new Info(BreakInfo::pickaxe(0.5))));

		$updateBlockBreakInfo = new Info(new BreakInfo(1.0));
		self::register("info_update", fn(int $id) => new Opaque(new BID($id), "update!", $updateBlockBreakInfo));
		self::register("info_update2", fn(int $id) => new Opaque(new BID($id), "ate!upd", $updateBlockBreakInfo));
		self::register("invisible_bedrock", fn(int $id) => new Transparent(new BID($id), "Invisible Bedrock", new Info(BreakInfo::indestructible())));

		$ironBreakInfo = new Info(BreakInfo::pickaxe(5.0, ToolTier::STONE, 30.0));
		self::register("iron", fn(int $id) => new Opaque(new BID($id), "Iron Block", $ironBreakInfo));
		self::register("iron_bars", fn(int $id) => new Thin(new BID($id), "Iron Bars", $ironBreakInfo));
		$ironDoorBreakInfo = new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD, 25.0));
		self::register("iron_door", fn(int $id) => new Door(new BID($id), "Iron Door", $ironDoorBreakInfo));
		self::register("iron_trapdoor", fn(int $id) => new Trapdoor(new BID($id), "Iron Trapdoor", $ironDoorBreakInfo));

		$itemFrameInfo = new Info(new BreakInfo(0.25));
		self::register("item_frame", fn(int $id) => new ItemFrame(new BID($id, TileItemFrame::class), "Item Frame", $itemFrameInfo));
		self::register("glowing_item_frame", fn(int $id) => new ItemFrame(new BID($id, TileGlowingItemFrame::class), "Glow Item Frame", $itemFrameInfo));

		self::register("jukebox", fn(int $id) => new Jukebox(new BID($id, TileJukebox::class), "Jukebox", new Info(BreakInfo::axe(0.8)))); //TODO: in PC the hardness is 2.0, not 0.8, unsure if this is a MCPE bug or not
		self::register("ladder", fn(int $id) => new Ladder(new BID($id), "Ladder", new Info(BreakInfo::axe(0.4))));

		$lanternBreakInfo = new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD));
		self::register("lantern", fn(int $id) => new Lantern(new BID($id), "Lantern", $lanternBreakInfo, 15));
		self::register("soul_lantern", fn(int $id) => new Lantern(new BID($id), "Soul Lantern", $lanternBreakInfo, 10));

		self::register("lapis_lazuli", fn(int $id) => new Opaque(new BID($id), "Lapis Lazuli Block", new Info(BreakInfo::pickaxe(3.0, ToolTier::STONE))));
		self::register("lava", fn(int $id) => new Lava(new BID($id), "Lava", new Info(BreakInfo::indestructible(500.0))));
		self::register("lectern", fn(int $id) => new Lectern(new BID($id, TileLectern::class), "Lectern", new Info(BreakInfo::axe(2.0))));
		self::register("lever", fn(int $id) => new Lever(new BID($id), "Lever", new Info(new BreakInfo(0.5))));
		self::register("magma", fn(int $id) => new Magma(new BID($id), "Magma Block", new Info(BreakInfo::pickaxe(0.5, ToolTier::WOOD))));
		self::register("melon", fn(int $id) => new Melon(new BID($id), "Melon Block", new Info(BreakInfo::axe(1.0))));
		self::register("melon_stem", fn(int $id) => new MelonStem(new BID($id), "Melon Stem", new Info(BreakInfo::instant())));
		self::register("monster_spawner", fn(int $id) => new MonsterSpawner(new BID($id, TileMonsterSpawner::class), "Monster Spawner", new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD))));
		self::register("mycelium", fn(int $id) => new Mycelium(new BID($id), "Mycelium", new Info(BreakInfo::shovel(0.6), [Tags::DIRT])));

		$netherBrickBreakInfo = new Info(BreakInfo::pickaxe(2.0, ToolTier::WOOD, 30.0));
		self::register("nether_bricks", fn(int $id) => new Opaque(new BID($id), "Nether Bricks", $netherBrickBreakInfo));
		self::register("red_nether_bricks", fn(int $id) => new Opaque(new BID($id), "Red Nether Bricks", $netherBrickBreakInfo));
		self::register("nether_brick_fence", fn(int $id) => new Fence(new BID($id), "Nether Brick Fence", $netherBrickBreakInfo));
		self::register("nether_brick_stairs", fn(int $id) => new Stair(new BID($id), "Nether Brick Stairs", $netherBrickBreakInfo));
		self::register("red_nether_brick_stairs", fn(int $id) => new Stair(new BID($id), "Red Nether Brick Stairs", $netherBrickBreakInfo));
		self::register("chiseled_nether_bricks", fn(int $id) => new Opaque(new BID($id), "Chiseled Nether Bricks", $netherBrickBreakInfo));
		self::register("cracked_nether_bricks", fn(int $id) => new Opaque(new BID($id), "Cracked Nether Bricks", $netherBrickBreakInfo));

		self::register("nether_portal", fn(int $id) => new NetherPortal(new BID($id), "Nether Portal", new Info(BreakInfo::indestructible(0.0))));
		self::register("nether_reactor_core", fn(int $id) => new NetherReactor(new BID($id), "Nether Reactor Core", new Info(BreakInfo::pickaxe(3.0, ToolTier::WOOD))));
		self::register("nether_wart_block", fn(int $id) => new Opaque(new BID($id), "Nether Wart Block", new Info(new BreakInfo(1.0, ToolType::HOE))));
		self::register("nether_wart", fn(int $id) => new NetherWartPlant(new BID($id), "Nether Wart", new Info(BreakInfo::instant())));
		self::register("netherrack", fn(int $id) => new Netherrack(new BID($id), "Netherrack", new Info(BreakInfo::pickaxe(0.4, ToolTier::WOOD))));
		self::register("note_block", fn(int $id) => new Note(new BID($id, TileNote::class), "Note Block", new Info(BreakInfo::axe(0.8))));
		self::register("obsidian", fn(int $id) => new Opaque(new BID($id), "Obsidian", new Info(BreakInfo::pickaxe(35.0 /* 50 in PC */,  ToolTier::DIAMOND, 6000.0))));
		self::register("packed_ice", fn(int $id) => new PackedIce(new BID($id), "Packed Ice", new Info(BreakInfo::pickaxe(0.5))));
		self::register("podzol", fn(int $id) => new Podzol(new BID($id), "Podzol", new Info(BreakInfo::shovel(0.5), [Tags::DIRT])));
		self::register("potatoes", fn(int $id) => new Potato(new BID($id), "Potato Block", new Info(BreakInfo::instant())));
		self::register("powered_rail", fn(int $id) => new PoweredRail(new BID($id), "Powered Rail", $railBreakInfo));

		$prismarineBreakInfo = new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0));
		self::register("prismarine", fn(int $id) => new Opaque(new BID($id), "Prismarine", $prismarineBreakInfo));
		self::register("dark_prismarine", fn(int $id) => new Opaque(new BID($id), "Dark Prismarine", $prismarineBreakInfo));
		self::register("prismarine_bricks", fn(int $id) => new Opaque(new BID($id), "Prismarine Bricks", $prismarineBreakInfo));
		self::register("prismarine_bricks_stairs", fn(int $id) => new Stair(new BID($id), "Prismarine Bricks Stairs", $prismarineBreakInfo));
		self::register("dark_prismarine_stairs", fn(int $id) => new Stair(new BID($id), "Dark Prismarine Stairs", $prismarineBreakInfo));
		self::register("prismarine_stairs", fn(int $id) => new Stair(new BID($id), "Prismarine Stairs", $prismarineBreakInfo));

		$pumpkinBreakInfo = new Info(BreakInfo::axe(1.0));
		self::register("pumpkin", fn(int $id) => new Pumpkin(new BID($id), "Pumpkin", $pumpkinBreakInfo));
		self::register("carved_pumpkin", fn(int $id) => new CarvedPumpkin(new BID($id), "Carved Pumpkin", new Info(BreakInfo::axe(1.0), enchantmentTags: [EnchantmentTags::MASK])));
		self::register("lit_pumpkin", fn(int $id) => new LitPumpkin(new BID($id), "Jack o'Lantern", $pumpkinBreakInfo));

		self::register("pumpkin_stem", fn(int $id) => new PumpkinStem(new BID($id), "Pumpkin Stem", new Info(BreakInfo::instant())));

		$purpurBreakInfo = new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0));
		self::register("purpur", fn(int $id) => new Opaque(new BID($id), "Purpur Block", $purpurBreakInfo));
		self::register("purpur_pillar", fn(int $id) => new SimplePillar(new BID($id), "Purpur Pillar", $purpurBreakInfo));
		self::register("purpur_stairs", fn(int $id) => new Stair(new BID($id), "Purpur Stairs", $purpurBreakInfo));

		$quartzBreakInfo = new Info(BreakInfo::pickaxe(0.8, ToolTier::WOOD));
		self::register("quartz", fn(int $id) => new Opaque(new BID($id), "Quartz Block", $quartzBreakInfo));
		self::register("chiseled_quartz", fn(int $id) => new SimplePillar(new BID($id), "Chiseled Quartz Block", $quartzBreakInfo));
		self::register("quartz_pillar", fn(int $id) => new SimplePillar(new BID($id), "Quartz Pillar", $quartzBreakInfo));
		self::register("smooth_quartz", fn(int $id) => new Opaque(new BID($id), "Smooth Quartz Block", $quartzBreakInfo));
		self::register("quartz_bricks", fn(int $id) => new Opaque(new BID($id), "Quartz Bricks", $quartzBreakInfo));

		self::register("quartz_stairs", fn(int $id) => new Stair(new BID($id), "Quartz Stairs", $quartzBreakInfo));
		self::register("smooth_quartz_stairs", fn(int $id) => new Stair(new BID($id), "Smooth Quartz Stairs", $quartzBreakInfo));

		self::register("rail", fn(int $id) => new Rail(new BID($id), "Rail", $railBreakInfo));
		self::register("red_mushroom", fn(int $id) => new RedMushroom(new BID($id), "Red Mushroom", new Info(BreakInfo::instant(), [Tags::POTTABLE_PLANTS])));
		self::register("redstone", fn(int $id) => new Redstone(new BID($id), "Redstone Block", new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD, 30.0))));
		self::register("redstone_comparator", fn(int $id) => new RedstoneComparator(new BID($id, TileComparator::class), "Redstone Comparator", new Info(BreakInfo::instant())));
		self::register("redstone_lamp", fn(int $id) => new RedstoneLamp(new BID($id), "Redstone Lamp", new Info(new BreakInfo(0.3))));
		self::register("redstone_repeater", fn(int $id) => new RedstoneRepeater(new BID($id), "Redstone Repeater", new Info(BreakInfo::instant())));
		self::register("redstone_torch", fn(int $id) => new RedstoneTorch(new BID($id), "Redstone Torch", new Info(BreakInfo::instant())));
		self::register("redstone_wire", fn(int $id) => new RedstoneWire(new BID($id), "Redstone", new Info(BreakInfo::instant())));
		self::register("reserved6", fn(int $id) => new Reserved6(new BID($id), "reserved6", new Info(BreakInfo::instant())));

		$sandTypeInfo = new Info(BreakInfo::shovel(0.5), [Tags::SAND]);
		self::register("sand", fn(int $id) => new Sand(new BID($id), "Sand", $sandTypeInfo));
		self::register("red_sand", fn(int $id) => new Sand(new BID($id), "Red Sand", $sandTypeInfo));

		self::register("sea_lantern", fn(int $id) => new SeaLantern(new BID($id), "Sea Lantern", new Info(new BreakInfo(0.3))));
		self::register("sea_pickle", fn(int $id) => new SeaPickle(new BID($id), "Sea Pickle", new Info(BreakInfo::instant())));
		self::register("mob_head", fn(int $id) => new MobHead(new BID($id, TileMobHead::class), "Mob Head", new Info(new BreakInfo(1.0), enchantmentTags: [EnchantmentTags::MASK])));
		self::register("slime", fn(int $id) => new Slime(new BID($id), "Slime Block", new Info(BreakInfo::instant())));
		self::register("snow", fn(int $id) => new Snow(new BID($id), "Snow Block", new Info(BreakInfo::shovel(0.2, ToolTier::WOOD))));
		self::register("snow_layer", fn(int $id) => new SnowLayer(new BID($id), "Snow Layer", new Info(BreakInfo::shovel(0.1, ToolTier::WOOD))));
		self::register("soul_sand", fn(int $id) => new SoulSand(new BID($id), "Soul Sand", new Info(BreakInfo::shovel(0.5))));
		self::register("sponge", fn(int $id) => new Sponge(new BID($id), "Sponge", new Info(new BreakInfo(0.6, ToolType::HOE))));
		$shulkerBoxBreakInfo = new Info(BreakInfo::pickaxe(2));
		self::register("shulker_box", fn(int $id) => new ShulkerBox(new BID($id, TileShulkerBox::class), "Shulker Box", $shulkerBoxBreakInfo));

		$stoneBreakInfo = new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0));
		$stone = self::register(
			"stone",
			fn(int $id) => new class(new BID($id), "Stone", $stoneBreakInfo) extends Opaque{
				public function getDropsForCompatibleTool(Item $item) : array{
					return [VanillaBlocks::COBBLESTONE()->asItem()];
				}

				public function isAffectedBySilkTouch() : bool{
					return true;
				}
			}
		);
		self::register("andesite", fn(int $id) => new Opaque(new BID($id), "Andesite", $stoneBreakInfo));
		self::register("diorite", fn(int $id) => new Opaque(new BID($id), "Diorite", $stoneBreakInfo));
		self::register("granite", fn(int $id) => new Opaque(new BID($id), "Granite", $stoneBreakInfo));
		self::register("polished_andesite", fn(int $id) => new Opaque(new BID($id), "Polished Andesite", $stoneBreakInfo));
		self::register("polished_diorite", fn(int $id) => new Opaque(new BID($id), "Polished Diorite", $stoneBreakInfo));
		self::register("polished_granite", fn(int $id) => new Opaque(new BID($id), "Polished Granite", $stoneBreakInfo));

		$stoneBrick = self::register("stone_bricks", fn(int $id) => new Opaque(new BID($id), "Stone Bricks", $stoneBreakInfo));
		$mossyStoneBrick = self::register("mossy_stone_bricks", fn(int $id) => new Opaque(new BID($id), "Mossy Stone Bricks", $stoneBreakInfo));
		$crackedStoneBrick = self::register("cracked_stone_bricks", fn(int $id) => new Opaque(new BID($id), "Cracked Stone Bricks", $stoneBreakInfo));
		$chiseledStoneBrick = self::register("chiseled_stone_bricks", fn(int $id) => new Opaque(new BID($id), "Chiseled Stone Bricks", $stoneBreakInfo));

		$infestedStoneBreakInfo = new Info(BreakInfo::pickaxe(0.75));
		self::register("infested_stone", fn(int $id) => new InfestedStone(new BID($id), "Infested Stone", $infestedStoneBreakInfo, $stone));
		self::register("infested_stone_brick", fn(int $id) => new InfestedStone(new BID($id), "Infested Stone Brick", $infestedStoneBreakInfo, $stoneBrick));
		self::register("infested_cobblestone", fn(int $id) => new InfestedStone(new BID($id), "Infested Cobblestone", $infestedStoneBreakInfo, $cobblestone));
		self::register("infested_mossy_stone_brick", fn(int $id) => new InfestedStone(new BID($id), "Infested Mossy Stone Brick", $infestedStoneBreakInfo, $mossyStoneBrick));
		self::register("infested_cracked_stone_brick", fn(int $id) => new InfestedStone(new BID($id), "Infested Cracked Stone Brick", $infestedStoneBreakInfo, $crackedStoneBrick));
		self::register("infested_chiseled_stone_brick", fn(int $id) => new InfestedStone(new BID($id), "Infested Chiseled Stone Brick", $infestedStoneBreakInfo, $chiseledStoneBrick));

		self::register("stone_stairs", fn(int $id) => new Stair(new BID($id), "Stone Stairs", $stoneBreakInfo));
		self::register("smooth_stone", fn(int $id) => new Opaque(new BID($id), "Smooth Stone", $stoneBreakInfo));
		self::register("andesite_stairs", fn(int $id) => new Stair(new BID($id), "Andesite Stairs", $stoneBreakInfo));
		self::register("diorite_stairs", fn(int $id) => new Stair(new BID($id), "Diorite Stairs", $stoneBreakInfo));
		self::register("granite_stairs", fn(int $id) => new Stair(new BID($id), "Granite Stairs", $stoneBreakInfo));
		self::register("polished_andesite_stairs", fn(int $id) => new Stair(new BID($id), "Polished Andesite Stairs", $stoneBreakInfo));
		self::register("polished_diorite_stairs", fn(int $id) => new Stair(new BID($id), "Polished Diorite Stairs", $stoneBreakInfo));
		self::register("polished_granite_stairs", fn(int $id) => new Stair(new BID($id), "Polished Granite Stairs", $stoneBreakInfo));
		self::register("stone_brick_stairs", fn(int $id) => new Stair(new BID($id), "Stone Brick Stairs", $stoneBreakInfo));
		self::register("mossy_stone_brick_stairs", fn(int $id) => new Stair(new BID($id), "Mossy Stone Brick Stairs", $stoneBreakInfo));
		self::register("stone_button", fn(int $id) => new StoneButton(new BID($id), "Stone Button", new Info(BreakInfo::pickaxe(0.5))));
		self::register("stonecutter", fn(int $id) => new Stonecutter(new BID($id), "Stonecutter", new Info(BreakInfo::pickaxe(3.5))));
		self::register("stone_pressure_plate", fn(int $id) => new StonePressurePlate(new BID($id), "Stone Pressure Plate", new Info(BreakInfo::pickaxe(0.5, ToolTier::WOOD))));

		//TODO: in the future this won't be the same for all the types
		$stoneSlabBreakInfo = new Info(BreakInfo::pickaxe(2.0, ToolTier::WOOD, 30.0));

		self::register("brick_slab", fn(int $id) => new Slab(new BID($id), "Brick", $stoneSlabBreakInfo));
		self::register("cobblestone_slab", fn(int $id) => new Slab(new BID($id), "Cobblestone", $stoneSlabBreakInfo));
		self::register("fake_wooden_slab", fn(int $id) => new Slab(new BID($id), "Fake Wooden", $stoneSlabBreakInfo));
		self::register("nether_brick_slab", fn(int $id) => new Slab(new BID($id), "Nether Brick", $stoneSlabBreakInfo));
		self::register("quartz_slab", fn(int $id) => new Slab(new BID($id), "Quartz", $stoneSlabBreakInfo));
		self::register("sandstone_slab", fn(int $id) => new Slab(new BID($id), "Sandstone", $stoneSlabBreakInfo));
		self::register("smooth_stone_slab", fn(int $id) => new Slab(new BID($id), "Smooth Stone", $stoneSlabBreakInfo));
		self::register("stone_brick_slab", fn(int $id) => new Slab(new BID($id), "Stone Brick", $stoneSlabBreakInfo));
		self::register("dark_prismarine_slab", fn(int $id) => new Slab(new BID($id), "Dark Prismarine", $stoneSlabBreakInfo));
		self::register("mossy_cobblestone_slab", fn(int $id) => new Slab(new BID($id), "Mossy Cobblestone", $stoneSlabBreakInfo));
		self::register("prismarine_slab", fn(int $id) => new Slab(new BID($id), "Prismarine", $stoneSlabBreakInfo));
		self::register("prismarine_bricks_slab", fn(int $id) => new Slab(new BID($id), "Prismarine Bricks", $stoneSlabBreakInfo));
		self::register("purpur_slab", fn(int $id) => new Slab(new BID($id), "Purpur", $stoneSlabBreakInfo));
		self::register("red_nether_brick_slab", fn(int $id) => new Slab(new BID($id), "Red Nether Brick", $stoneSlabBreakInfo));
		self::register("red_sandstone_slab", fn(int $id) => new Slab(new BID($id), "Red Sandstone", $stoneSlabBreakInfo));
		self::register("smooth_sandstone_slab", fn(int $id) => new Slab(new BID($id), "Smooth Sandstone", $stoneSlabBreakInfo));
		self::register("andesite_slab", fn(int $id) => new Slab(new BID($id), "Andesite", $stoneSlabBreakInfo));
		self::register("diorite_slab", fn(int $id) => new Slab(new BID($id), "Diorite", $stoneSlabBreakInfo));
		self::register("end_stone_brick_slab", fn(int $id) => new Slab(new BID($id), "End Stone Brick", $stoneSlabBreakInfo));
		self::register("granite_slab", fn(int $id) => new Slab(new BID($id), "Granite", $stoneSlabBreakInfo));
		self::register("polished_andesite_slab", fn(int $id) => new Slab(new BID($id), "Polished Andesite", $stoneSlabBreakInfo));
		self::register("polished_diorite_slab", fn(int $id) => new Slab(new BID($id), "Polished Diorite", $stoneSlabBreakInfo));
		self::register("polished_granite_slab", fn(int $id) => new Slab(new BID($id), "Polished Granite", $stoneSlabBreakInfo));
		self::register("smooth_red_sandstone_slab", fn(int $id) => new Slab(new BID($id), "Smooth Red Sandstone", $stoneSlabBreakInfo));
		self::register("cut_red_sandstone_slab", fn(int $id) => new Slab(new BID($id), "Cut Red Sandstone", $stoneSlabBreakInfo));
		self::register("cut_sandstone_slab", fn(int $id) => new Slab(new BID($id), "Cut Sandstone", $stoneSlabBreakInfo));
		self::register("mossy_stone_brick_slab", fn(int $id) => new Slab(new BID($id), "Mossy Stone Brick", $stoneSlabBreakInfo));
		self::register("smooth_quartz_slab", fn(int $id) => new Slab(new BID($id), "Smooth Quartz", $stoneSlabBreakInfo));
		self::register("stone_slab", fn(int $id) => new Slab(new BID($id), "Stone", $stoneSlabBreakInfo));

		self::register("legacy_stonecutter", fn(int $id) => new Opaque(new BID($id), "Legacy Stonecutter", new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD))));
		self::register("sugarcane", fn(int $id) => new Sugarcane(new BID($id), "Sugarcane", new Info(BreakInfo::instant())));
		self::register("sweet_berry_bush", fn(int $id) => new SweetBerryBush(new BID($id), "Sweet Berry Bush", new Info(BreakInfo::instant())));
		self::register("tnt", fn(int $id) => new TNT(new BID($id), "TNT", new Info(BreakInfo::instant())));
		self::register("fern", fn(int $id) => new TallGrass(new BID($id), "Fern", new Info(BreakInfo::instant(ToolType::SHEARS, 1), [Tags::POTTABLE_PLANTS])));
		self::register("tall_grass", fn(int $id) => new TallGrass(new BID($id), "Tall Grass", new Info(BreakInfo::instant(ToolType::SHEARS, 1))));

		self::register("blue_torch", fn(int $id) => new Torch(new BID($id), "Blue Torch", new Info(BreakInfo::instant())));
		self::register("purple_torch", fn(int $id) => new Torch(new BID($id), "Purple Torch", new Info(BreakInfo::instant())));
		self::register("red_torch", fn(int $id) => new Torch(new BID($id), "Red Torch", new Info(BreakInfo::instant())));
		self::register("green_torch", fn(int $id) => new Torch(new BID($id), "Green Torch", new Info(BreakInfo::instant())));
		self::register("torch", fn(int $id) => new Torch(new BID($id), "Torch", new Info(BreakInfo::instant())));

		self::register("trapped_chest", fn(int $id) => new TrappedChest(new BID($id, TileChest::class), "Trapped Chest", $chestBreakInfo));
		self::register("tripwire", fn(int $id) => new Tripwire(new BID($id), "Tripwire", new Info(BreakInfo::instant())));
		self::register("tripwire_hook", fn(int $id) => new TripwireHook(new BID($id), "Tripwire Hook", new Info(BreakInfo::instant())));
		self::register("underwater_torch", fn(int $id) => new UnderwaterTorch(new BID($id), "Underwater Torch", new Info(BreakInfo::instant())));
		self::register("vines", fn(int $id) => new Vine(new BID($id), "Vines", new Info(BreakInfo::axe(0.2))));
		self::register("water", fn(int $id) => new Water(new BID($id), "Water", new Info(BreakInfo::indestructible(500.0))));
		self::register("lily_pad", fn(int $id) => new WaterLily(new BID($id), "Lily Pad", new Info(BreakInfo::instant())));

		$weightedPressurePlateBreakInfo = new Info(BreakInfo::pickaxe(0.5, ToolTier::WOOD));
		self::register("weighted_pressure_plate_heavy", fn(int $id) => new WeightedPressurePlateHeavy(
			new BID($id),
			"Weighted Pressure Plate Heavy",
			$weightedPressurePlateBreakInfo,
			deactivationDelayTicks: 10,
			signalStrengthFactor: 0.1
		));
		self::register("weighted_pressure_plate_light", fn(int $id) => new WeightedPressurePlateLight(
			new BID($id),
			"Weighted Pressure Plate Light",
			$weightedPressurePlateBreakInfo,
			deactivationDelayTicks: 10,
			signalStrengthFactor: 1.0
		));
		self::register("wheat", fn(int $id) => new Wheat(new BID($id), "Wheat Block", new Info(BreakInfo::instant())));

		$leavesBreakInfo = new Info(new class(0.2, ToolType::HOE) extends BreakInfo{
			public function getBreakTime(Item $item) : float{
				if($item->getBlockToolType() === ToolType::SHEARS){
					return 0.0;
				}
				return parent::getBreakTime($item);
			}
		});
		$saplingTypeInfo = new Info(BreakInfo::instant(), [Tags::POTTABLE_PLANTS]);

		foreach(SaplingType::cases() as $saplingType){
			$name = $saplingType->getDisplayName();
			self::register(strtolower($saplingType->name) . "_sapling", fn(int $id) => new Sapling(new BID($id), $name . " Sapling", $saplingTypeInfo, $saplingType));
		}
		foreach(LeavesType::cases() as $leavesType){
			$name = $leavesType->getDisplayName();
			self::register(strtolower($leavesType->name) . "_leaves", fn(int $id) => new Leaves(new BID($id), $name . " Leaves", $leavesBreakInfo, $leavesType));
		}

		$sandstoneBreakInfo = new Info(BreakInfo::pickaxe(0.8, ToolTier::WOOD));
		self::register("red_sandstone_stairs", fn(int $id) => new Stair(new BID($id), "Red Sandstone Stairs", $sandstoneBreakInfo));
		self::register("smooth_red_sandstone_stairs", fn(int $id) => new Stair(new BID($id), "Smooth Red Sandstone Stairs", $sandstoneBreakInfo));
		self::register("red_sandstone", fn(int $id) => new Opaque(new BID($id), "Red Sandstone", $sandstoneBreakInfo));
		self::register("chiseled_red_sandstone", fn(int $id) => new Opaque(new BID($id), "Chiseled Red Sandstone", $sandstoneBreakInfo));
		self::register("cut_red_sandstone", fn(int $id) => new Opaque(new BID($id), "Cut Red Sandstone", $sandstoneBreakInfo));
		self::register("smooth_red_sandstone", fn(int $id) => new Opaque(new BID($id), "Smooth Red Sandstone", $sandstoneBreakInfo));

		self::register("sandstone_stairs", fn(int $id) => new Stair(new BID($id), "Sandstone Stairs", $sandstoneBreakInfo));
		self::register("smooth_sandstone_stairs", fn(int $id) => new Stair(new BID($id), "Smooth Sandstone Stairs", $sandstoneBreakInfo));
		self::register("sandstone", fn(int $id) => new Opaque(new BID($id), "Sandstone", $sandstoneBreakInfo));
		self::register("chiseled_sandstone", fn(int $id) => new Opaque(new BID($id), "Chiseled Sandstone", $sandstoneBreakInfo));
		self::register("cut_sandstone", fn(int $id) => new Opaque(new BID($id), "Cut Sandstone", $sandstoneBreakInfo));
		self::register("smooth_sandstone", fn(int $id) => new Opaque(new BID($id), "Smooth Sandstone", $sandstoneBreakInfo));

		self::register("glazed_terracotta", fn(int $id) => new GlazedTerracotta(new BID($id), "Glazed Terracotta", new Info(BreakInfo::pickaxe(1.4, ToolTier::WOOD))));
		self::register("dyed_shulker_box", fn(int $id) => new DyedShulkerBox(new BID($id, TileShulkerBox::class), "Dyed Shulker Box", $shulkerBoxBreakInfo));
		self::register("stained_glass", fn(int $id) => new StainedGlass(new BID($id), "Stained Glass", $glassBreakInfo));
		self::register("stained_glass_pane", fn(int $id) => new StainedGlassPane(new BID($id), "Stained Glass Pane", $glassBreakInfo));
		self::register("stained_clay", fn(int $id) => new StainedHardenedClay(new BID($id), "Stained Clay", $hardenedClayBreakInfo));
		self::register("stained_hardened_glass", fn(int $id) => new StainedHardenedGlass(new BID($id), "Stained Hardened Glass", $hardenedGlassBreakInfo));
		self::register("stained_hardened_glass_pane", fn(int $id) => new StainedHardenedGlassPane(new BID($id), "Stained Hardened Glass Pane", $hardenedGlassBreakInfo));
		self::register("carpet", fn(int $id) => new Carpet(new BID($id), "Carpet", new Info(new BreakInfo(0.1))));
		self::register("concrete", fn(int $id) => new Concrete(new BID($id), "Concrete", new Info(BreakInfo::pickaxe(1.8, ToolTier::WOOD))));
		self::register("concrete_powder", fn(int $id) => new ConcretePowder(new BID($id), "Concrete Powder", new Info(BreakInfo::shovel(0.5))));
		self::register("wool", fn(int $id) => new Wool(new BID($id), "Wool", new Info(new class(0.8, ToolType::SHEARS) extends BreakInfo{
			public function getBreakTime(Item $item) : float{
				$time = parent::getBreakTime($item);
				if($item->getBlockToolType() === ToolType::SHEARS){
					$time *= 3; //shears break compatible blocks 15x faster, but wool 5x
				}

				return $time;
			}
		})));

		//TODO: in the future these won't all have the same hardness; they only do now because of the old metadata crap
		$wallBreakInfo = new Info(BreakInfo::pickaxe(2.0, ToolTier::WOOD, 30.0));
		self::register("cobblestone_wall", fn(int $id) => new Wall(new BID($id), "Cobblestone Wall", $wallBreakInfo));
		self::register("andesite_wall", fn(int $id) => new Wall(new BID($id), "Andesite Wall", $wallBreakInfo));
		self::register("brick_wall", fn(int $id) => new Wall(new BID($id), "Brick Wall", $wallBreakInfo));
		self::register("diorite_wall", fn(int $id) => new Wall(new BID($id), "Diorite Wall", $wallBreakInfo));
		self::register("end_stone_brick_wall", fn(int $id) => new Wall(new BID($id), "End Stone Brick Wall", $wallBreakInfo));
		self::register("granite_wall", fn(int $id) => new Wall(new BID($id), "Granite Wall", $wallBreakInfo));
		self::register("mossy_stone_brick_wall", fn(int $id) => new Wall(new BID($id), "Mossy Stone Brick Wall", $wallBreakInfo));
		self::register("mossy_cobblestone_wall", fn(int $id) => new Wall(new BID($id), "Mossy Cobblestone Wall", $wallBreakInfo));
		self::register("nether_brick_wall", fn(int $id) => new Wall(new BID($id), "Nether Brick Wall", $wallBreakInfo));
		self::register("prismarine_wall", fn(int $id) => new Wall(new BID($id), "Prismarine Wall", $wallBreakInfo));
		self::register("red_nether_brick_wall", fn(int $id) => new Wall(new BID($id), "Red Nether Brick Wall", $wallBreakInfo));
		self::register("red_sandstone_wall", fn(int $id) => new Wall(new BID($id), "Red Sandstone Wall", $wallBreakInfo));
		self::register("sandstone_wall", fn(int $id) => new Wall(new BID($id), "Sandstone Wall", $wallBreakInfo));
		self::register("stone_brick_wall", fn(int $id) => new Wall(new BID($id), "Stone Brick Wall", $wallBreakInfo));

		self::registerElements();

		$chemistryTableBreakInfo = new Info(BreakInfo::pickaxe(2.5, ToolTier::WOOD));
		self::register("compound_creator", fn(int $id) => new ChemistryTable(new BID($id), "Compound Creator", $chemistryTableBreakInfo));
		self::register("element_constructor", fn(int $id) => new ChemistryTable(new BID($id), "Element Constructor", $chemistryTableBreakInfo));
		self::register("lab_table", fn(int $id) => new ChemistryTable(new BID($id), "Lab Table", $chemistryTableBreakInfo));
		self::register("material_reducer", fn(int $id) => new ChemistryTable(new BID($id), "Material Reducer", $chemistryTableBreakInfo));

		self::register("chemical_heat", fn(int $id) => new ChemicalHeat(new BID($id), "Heat Block", $chemistryTableBreakInfo));

		self::registerMushroomBlocks();

		self::register("coral", fn(int $id) => new Coral(
			new BID($id),
			"Coral",
			new Info(BreakInfo::instant()),
		));
		self::register("coral_fan", fn(int $id) => new FloorCoralFan(
			new BID($id),
			"Coral Fan",
			new Info(BreakInfo::instant()),
		));
		self::register("wall_coral_fan", fn(int $id) => new WallCoralFan(
			new BID($id),
			"Wall Coral Fan",
			new Info(BreakInfo::instant()),
		));

		self::register("mangrove_roots", fn(int $id) => new MangroveRoots(new BID($id), "Mangrove Roots", new Info(BreakInfo::axe(0.7))));
		self::register("muddy_mangrove_roots", fn(int $id) => new SimplePillar(new BID($id), "Muddy Mangrove Roots", new Info(BreakInfo::shovel(0.7), [Tags::MUD])));
		self::register("froglight", fn(int $id) => new Froglight(new BID($id), "Froglight", new Info(new BreakInfo(0.3))));
		self::register("sculk", fn(int $id) => new Sculk(new BID($id), "Sculk", new Info(new BreakInfo(0.6, ToolType::HOE))));
		self::register("reinforced_deepslate", fn(int $id) => new class(new BID($id), "Reinforced Deepslate", new Info(new BreakInfo(55.0, ToolType::NONE, 0, 3600.0))) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [];
			}
		});

		self::registerBlocksR13();
		self::registerBlocksR14();
		self::registerBlocksR16();
		self::registerBlocksR17();
		self::registerBlocksR18();
		self::registerMudBlocks();

		self::registerCraftingTables();
		self::registerChorusBlocks();
		self::registerOres();
		self::registerWoodenBlocks();
		self::registerCauldronBlocks();
	}

	private static function registerWoodenBlocks() : void{
		$planksBreakInfo = new Info(BreakInfo::axe(2.0, null, 15.0));
		$signBreakInfo = new Info(BreakInfo::axe(1.0));
		$logBreakInfo = new Info(BreakInfo::axe(2.0));
		$woodenDoorBreakInfo = new Info(BreakInfo::axe(3.0, null, 15.0));
		$woodenButtonBreakInfo = new Info(BreakInfo::axe(0.5));
		$woodenPressurePlateBreakInfo = new Info(BreakInfo::axe(0.5));

		foreach(WoodType::cases() as $woodType){
			$name = $woodType->getDisplayName();
			$idName = fn(string $suffix) => strtolower($woodType->name) . "_" . $suffix;

			self::register($idName(mb_strtolower($woodType->getStandardLogSuffix() ?? "log", 'US-ASCII')), fn(int $id) => new Wood(new BID($id), $name . " " . ($woodType->getStandardLogSuffix() ?? "Log"), $logBreakInfo, $woodType));
			self::register($idName(mb_strtolower($woodType->getAllSidedLogSuffix() ?? "wood", 'US-ASCII')), fn(int $id) => new Wood(new BID($id), $name . " " . ($woodType->getAllSidedLogSuffix() ?? "Wood"), $logBreakInfo, $woodType));

			self::register($idName("planks"), fn(int $id) => new Planks(new BID($id), $name . " Planks", $planksBreakInfo, $woodType));
			self::register($idName("fence"), fn(int $id) => new WoodenFence(new BID($id), $name . " Fence", $planksBreakInfo, $woodType));
			self::register($idName("slab"), fn(int $id) => new WoodenSlab(new BID($id), $name, $planksBreakInfo, $woodType));

			self::register($idName("fence_gate"), fn(int $id) => new FenceGate(new BID($id), $name . " Fence Gate", $planksBreakInfo, $woodType));
			self::register($idName("stairs"), fn(int $id) => new WoodenStairs(new BID($id), $name . " Stairs", $planksBreakInfo, $woodType));
			self::register($idName("door"), fn(int $id) => new WoodenDoor(new BID($id), $name . " Door", $woodenDoorBreakInfo, $woodType));

			self::register($idName("button"), fn(int $id) => new WoodenButton(new BID($id), $name . " Button", $woodenButtonBreakInfo, $woodType));
			self::register($idName("pressure_plate"), fn(int $id) => new WoodenPressurePlate(new BID($id), $name . " Pressure Plate", $woodenPressurePlateBreakInfo, $woodType, 20));
			self::register($idName("trapdoor"), fn(int $id) => new WoodenTrapdoor(new BID($id), $name . " Trapdoor", $woodenDoorBreakInfo, $woodType));

			$signAsItem = match($woodType){
				WoodType::OAK => VanillaItems::OAK_SIGN(...),
				WoodType::SPRUCE => VanillaItems::SPRUCE_SIGN(...),
				WoodType::BIRCH => VanillaItems::BIRCH_SIGN(...),
				WoodType::JUNGLE => VanillaItems::JUNGLE_SIGN(...),
				WoodType::ACACIA => VanillaItems::ACACIA_SIGN(...),
				WoodType::DARK_OAK => VanillaItems::DARK_OAK_SIGN(...),
				WoodType::MANGROVE => VanillaItems::MANGROVE_SIGN(...),
				WoodType::CRIMSON => VanillaItems::CRIMSON_SIGN(...),
				WoodType::WARPED => VanillaItems::WARPED_SIGN(...),
				WoodType::CHERRY => VanillaItems::CHERRY_SIGN(...),
			};
			self::register($idName("sign"), fn(int $id) => new FloorSign(new BID($id), $name . " Sign", $signBreakInfo, $woodType, $signAsItem));
			self::register($idName("wall_sign"), fn(int $id) => new WallSign(new BID($id), $name . " Wall Sign", $signBreakInfo, $woodType, $signAsItem));
		}
	}

	private static function registerMushroomBlocks() : void{
		$mushroomBlockBreakInfo = new Info(BreakInfo::axe(0.2));

		self::register("brown_mushroom_block", fn(int $id) => new BrownMushroomBlock(new BID($id), "Brown Mushroom Block", $mushroomBlockBreakInfo));
		self::register("red_mushroom_block", fn(int $id) => new RedMushroomBlock(new BID($id), "Red Mushroom Block", $mushroomBlockBreakInfo));

		//finally, the stems
		self::register("mushroom_stem", fn(int $id) => new MushroomStem(new BID($id), "Mushroom Stem", $mushroomBlockBreakInfo));
		self::register("all_sided_mushroom_stem", fn(int $id) => new MushroomStem(new BID($id), "All Sided Mushroom Stem", $mushroomBlockBreakInfo));
	}

	private static function registerElements() : void{
		$instaBreak = new Info(BreakInfo::instant());
		self::register("element_zero", fn(int $id) => new Opaque(new BID($id), "???", $instaBreak));

		$register = fn(string $name, string $displayName, string $symbol, int $atomicWeight, int $group) =>
			self::register("element_$name", fn(int $id) => new Element(new BID($id), $displayName, $instaBreak, $symbol, $atomicWeight, $group));

		$register("hydrogen", "Hydrogen", "h", 1, 5);
		$register("helium", "Helium", "he", 2, 7);
		$register("lithium", "Lithium", "li", 3, 0);
		$register("beryllium", "Beryllium", "be", 4, 1);
		$register("boron", "Boron", "b", 5, 4);
		$register("carbon", "Carbon", "c", 6, 5);
		$register("nitrogen", "Nitrogen", "n", 7, 5);
		$register("oxygen", "Oxygen", "o", 8, 5);
		$register("fluorine", "Fluorine", "f", 9, 6);
		$register("neon", "Neon", "ne", 10, 7);
		$register("sodium", "Sodium", "na", 11, 0);
		$register("magnesium", "Magnesium", "mg", 12, 1);
		$register("aluminum", "Aluminum", "al", 13, 3);
		$register("silicon", "Silicon", "si", 14, 4);
		$register("phosphorus", "Phosphorus", "p", 15, 5);
		$register("sulfur", "Sulfur", "s", 16, 5);
		$register("chlorine", "Chlorine", "cl", 17, 6);
		$register("argon", "Argon", "ar", 18, 7);
		$register("potassium", "Potassium", "k", 19, 0);
		$register("calcium", "Calcium", "ca", 20, 1);
		$register("scandium", "Scandium", "sc", 21, 2);
		$register("titanium", "Titanium", "ti", 22, 2);
		$register("vanadium", "Vanadium", "v", 23, 2);
		$register("chromium", "Chromium", "cr", 24, 2);
		$register("manganese", "Manganese", "mn", 25, 2);
		$register("iron", "Iron", "fe", 26, 2);
		$register("cobalt", "Cobalt", "co", 27, 2);
		$register("nickel", "Nickel", "ni", 28, 2);
		$register("copper", "Copper", "cu", 29, 2);
		$register("zinc", "Zinc", "zn", 30, 2);
		$register("gallium", "Gallium", "ga", 31, 3);
		$register("germanium", "Germanium", "ge", 32, 4);
		$register("arsenic", "Arsenic", "as", 33, 4);
		$register("selenium", "Selenium", "se", 34, 5);
		$register("bromine", "Bromine", "br", 35, 6);
		$register("krypton", "Krypton", "kr", 36, 7);
		$register("rubidium", "Rubidium", "rb", 37, 0);
		$register("strontium", "Strontium", "sr", 38, 1);
		$register("yttrium", "Yttrium", "y", 39, 2);
		$register("zirconium", "Zirconium", "zr", 40, 2);
		$register("niobium", "Niobium", "nb", 41, 2);
		$register("molybdenum", "Molybdenum", "mo", 42, 2);
		$register("technetium", "Technetium", "tc", 43, 2);
		$register("ruthenium", "Ruthenium", "ru", 44, 2);
		$register("rhodium", "Rhodium", "rh", 45, 2);
		$register("palladium", "Palladium", "pd", 46, 2);
		$register("silver", "Silver", "ag", 47, 2);
		$register("cadmium", "Cadmium", "cd", 48, 2);
		$register("indium", "Indium", "in", 49, 3);
		$register("tin", "Tin", "sn", 50, 3);
		$register("antimony", "Antimony", "sb", 51, 4);
		$register("tellurium", "Tellurium", "te", 52, 4);
		$register("iodine", "Iodine", "i", 53, 6);
		$register("xenon", "Xenon", "xe", 54, 7);
		$register("cesium", "Cesium", "cs", 55, 0);
		$register("barium", "Barium", "ba", 56, 1);
		$register("lanthanum", "Lanthanum", "la", 57, 8);
		$register("cerium", "Cerium", "ce", 58, 8);
		$register("praseodymium", "Praseodymium", "pr", 59, 8);
		$register("neodymium", "Neodymium", "nd", 60, 8);
		$register("promethium", "Promethium", "pm", 61, 8);
		$register("samarium", "Samarium", "sm", 62, 8);
		$register("europium", "Europium", "eu", 63, 8);
		$register("gadolinium", "Gadolinium", "gd", 64, 8);
		$register("terbium", "Terbium", "tb", 65, 8);
		$register("dysprosium", "Dysprosium", "dy", 66, 8);
		$register("holmium", "Holmium", "ho", 67, 8);
		$register("erbium", "Erbium", "er", 68, 8);
		$register("thulium", "Thulium", "tm", 69, 8);
		$register("ytterbium", "Ytterbium", "yb", 70, 8);
		$register("lutetium", "Lutetium", "lu", 71, 8);
		$register("hafnium", "Hafnium", "hf", 72, 2);
		$register("tantalum", "Tantalum", "ta", 73, 2);
		$register("tungsten", "Tungsten", "w", 74, 2);
		$register("rhenium", "Rhenium", "re", 75, 2);
		$register("osmium", "Osmium", "os", 76, 2);
		$register("iridium", "Iridium", "ir", 77, 2);
		$register("platinum", "Platinum", "pt", 78, 2);
		$register("gold", "Gold", "au", 79, 2);
		$register("mercury", "Mercury", "hg", 80, 2);
		$register("thallium", "Thallium", "tl", 81, 3);
		$register("lead", "Lead", "pb", 82, 3);
		$register("bismuth", "Bismuth", "bi", 83, 3);
		$register("polonium", "Polonium", "po", 84, 4);
		$register("astatine", "Astatine", "at", 85, 6);
		$register("radon", "Radon", "rn", 86, 7);
		$register("francium", "Francium", "fr", 87, 0);
		$register("radium", "Radium", "ra", 88, 1);
		$register("actinium", "Actinium", "ac", 89, 9);
		$register("thorium", "Thorium", "th", 90, 9);
		$register("protactinium", "Protactinium", "pa", 91, 9);
		$register("uranium", "Uranium", "u", 92, 9);
		$register("neptunium", "Neptunium", "np", 93, 9);
		$register("plutonium", "Plutonium", "pu", 94, 9);
		$register("americium", "Americium", "am", 95, 9);
		$register("curium", "Curium", "cm", 96, 9);
		$register("berkelium", "Berkelium", "bk", 97, 9);
		$register("californium", "Californium", "cf", 98, 9);
		$register("einsteinium", "Einsteinium", "es", 99, 9);
		$register("fermium", "Fermium", "fm", 100, 9);
		$register("mendelevium", "Mendelevium", "md", 101, 9);
		$register("nobelium", "Nobelium", "no", 102, 9);
		$register("lawrencium", "Lawrencium", "lr", 103, 9);
		$register("rutherfordium", "Rutherfordium", "rf", 104, 2);
		$register("dubnium", "Dubnium", "db", 105, 2);
		$register("seaborgium", "Seaborgium", "sg", 106, 2);
		$register("bohrium", "Bohrium", "bh", 107, 2);
		$register("hassium", "Hassium", "hs", 108, 2);
		$register("meitnerium", "Meitnerium", "mt", 109, 2);
		$register("darmstadtium", "Darmstadtium", "ds", 110, 2);
		$register("roentgenium", "Roentgenium", "rg", 111, 2);
		$register("copernicium", "Copernicium", "cn", 112, 2);
		$register("nihonium", "Nihonium", "nh", 113, 3);
		$register("flerovium", "Flerovium", "fl", 114, 3);
		$register("moscovium", "Moscovium", "mc", 115, 3);
		$register("livermorium", "Livermorium", "lv", 116, 3);
		$register("tennessine", "Tennessine", "ts", 117, 6);
		$register("oganesson", "Oganesson", "og", 118, 7);
	}

	private static function registerOres() : void{
		$stoneOreBreakInfo = fn(ToolTier $toolTier) => new Info(BreakInfo::pickaxe(3.0, $toolTier));
		self::register("coal_ore", fn(int $id) => new CoalOre(new BID($id), "Coal Ore", $stoneOreBreakInfo(ToolTier::WOOD)));
		self::register("copper_ore", fn(int $id) => new CopperOre(new BID($id), "Copper Ore", $stoneOreBreakInfo(ToolTier::STONE)));
		self::register("diamond_ore", fn(int $id) => new DiamondOre(new BID($id), "Diamond Ore", $stoneOreBreakInfo(ToolTier::IRON)));
		self::register("emerald_ore", fn(int $id) => new EmeraldOre(new BID($id), "Emerald Ore", $stoneOreBreakInfo(ToolTier::IRON)));
		self::register("gold_ore", fn(int $id) => new GoldOre(new BID($id), "Gold Ore", $stoneOreBreakInfo(ToolTier::IRON)));
		self::register("iron_ore", fn(int $id) => new IronOre(new BID($id), "Iron Ore", $stoneOreBreakInfo(ToolTier::STONE)));
		self::register("lapis_lazuli_ore", fn(int $id) => new LapisOre(new BID($id), "Lapis Lazuli Ore", $stoneOreBreakInfo(ToolTier::STONE)));
		self::register("redstone_ore", fn(int $id) => new RedstoneOre(new BID($id), "Redstone Ore", $stoneOreBreakInfo(ToolTier::IRON)));

		$deepslateOreBreakInfo = fn(ToolTier $toolTier) => new Info(BreakInfo::pickaxe(4.5, $toolTier));
		self::register("deepslate_coal_ore", fn(int $id) => new CoalOre(new BID($id), "Deepslate Coal Ore", $deepslateOreBreakInfo(ToolTier::WOOD)));
		self::register("deepslate_copper_ore", fn(int $id) => new CopperOre(new BID($id), "Deepslate Copper Ore", $deepslateOreBreakInfo(ToolTier::STONE)));
		self::register("deepslate_diamond_ore", fn(int $id) => new DiamondOre(new BID($id), "Deepslate Diamond Ore", $deepslateOreBreakInfo(ToolTier::IRON)));
		self::register("deepslate_emerald_ore", fn(int $id) => new EmeraldOre(new BID($id), "Deepslate Emerald Ore", $deepslateOreBreakInfo(ToolTier::IRON)));
		self::register("deepslate_gold_ore", fn(int $id) => new GoldOre(new BID($id), "Deepslate Gold Ore", $deepslateOreBreakInfo(ToolTier::IRON)));
		self::register("deepslate_iron_ore", fn(int $id) => new IronOre(new BID($id), "Deepslate Iron Ore", $deepslateOreBreakInfo(ToolTier::STONE)));
		self::register("deepslate_lapis_lazuli_ore", fn(int $id) => new LapisOre(new BID($id), "Deepslate Lapis Lazuli Ore", $deepslateOreBreakInfo(ToolTier::STONE)));
		self::register("deepslate_redstone_ore", fn(int $id) => new RedstoneOre(new BID($id), "Deepslate Redstone Ore", $deepslateOreBreakInfo(ToolTier::IRON)));

		$netherrackOreBreakInfo = new Info(BreakInfo::pickaxe(3.0, ToolTier::WOOD));
		self::register("nether_quartz_ore", fn(int $id) => new NetherQuartzOre(new BID($id), "Nether Quartz Ore", $netherrackOreBreakInfo));
		self::register("nether_gold_ore", fn(int $id) => new NetherGoldOre(new BID($id), "Nether Gold Ore", $netherrackOreBreakInfo));
	}

	private static function registerCraftingTables() : void{
		//TODO: this is the same for all wooden crafting blocks
		$craftingBlockBreakInfo = new Info(BreakInfo::axe(2.5));
		self::register("cartography_table", fn(int $id) => new CartographyTable(new BID($id), "Cartography Table", $craftingBlockBreakInfo));
		self::register("crafting_table", fn(int $id) => new CraftingTable(new BID($id), "Crafting Table", $craftingBlockBreakInfo));
		self::register("fletching_table", fn(int $id) => new FletchingTable(new BID($id), "Fletching Table", $craftingBlockBreakInfo));
		self::register("loom", fn(int $id) => new Loom(new BID($id), "Loom", $craftingBlockBreakInfo));
		self::register("smithing_table", fn(int $id) => new SmithingTable(new BID($id), "Smithing Table", $craftingBlockBreakInfo));
	}

	private static function registerChorusBlocks() : void{
		$chorusBlockBreakInfo = new Info(BreakInfo::axe(0.4));
		self::register("chorus_plant", fn(int $id) => new ChorusPlant(new BID($id), "Chorus Plant", $chorusBlockBreakInfo));
		self::register("chorus_flower", fn(int $id) => new ChorusFlower(new BID($id), "Chorus Flower", $chorusBlockBreakInfo));
	}

	private static function registerBlocksR13() : void{
		self::register("light", fn(int $id) => new Light(new BID($id), "Light Block", new Info(BreakInfo::indestructible())));
		self::register("wither_rose", fn(int $id) => new WitherRose(new BID($id), "Wither Rose", new Info(BreakInfo::instant(), [Tags::POTTABLE_PLANTS])));
	}

	private static function registerBlocksR14() : void{
		self::register("honeycomb", fn(int $id) => new Opaque(new BID($id), "Honeycomb Block", new Info(new BreakInfo(0.6))));
	}

	private static function registerBlocksR16() : void{
		//for some reason, slabs have weird hardness like the legacy ones
		$slabBreakInfo = new Info(BreakInfo::pickaxe(2.0, ToolTier::WOOD, 30.0));

		self::register("ancient_debris", fn(int $id) => new class(new BID($id), "Ancient Debris", new Info(BreakInfo::pickaxe(30, ToolTier::DIAMOND, 3600.0))) extends Opaque{
			public function isFireProofAsItem() : bool{ return true; }
		});
		$netheriteBreakInfo = new Info(BreakInfo::pickaxe(50, ToolTier::DIAMOND, 3600.0));
		self::register("netherite", fn(int $id) => new class(new BID($id), "Netherite Block", $netheriteBreakInfo) extends Opaque{
			public function isFireProofAsItem() : bool{ return true; }
		});

		$basaltBreakInfo = new Info(BreakInfo::pickaxe(1.25, ToolTier::WOOD, 21.0));
		self::register("basalt", fn(int $id) => new SimplePillar(new BID($id), "Basalt", $basaltBreakInfo));
		self::register("polished_basalt", fn(int $id) => new SimplePillar(new BID($id), "Polished Basalt", $basaltBreakInfo));
		self::register("smooth_basalt", fn(int $id) => new Opaque(new BID($id), "Smooth Basalt", $basaltBreakInfo));

		$blackstoneBreakInfo = new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0));
		self::register("blackstone", fn(int $id) => new Opaque(new BID($id), "Blackstone", $blackstoneBreakInfo));
		self::register("blackstone_slab", fn(int $id) => new Slab(new BID($id), "Blackstone", $slabBreakInfo));
		self::register("blackstone_stairs", fn(int $id) => new Stair(new BID($id), "Blackstone Stairs", $blackstoneBreakInfo));
		self::register("blackstone_wall", fn(int $id) => new Wall(new BID($id), "Blackstone Wall", $blackstoneBreakInfo));

		self::register("gilded_blackstone", fn(int $id) => new GildedBlackstone(new BID($id), "Gilded Blackstone", $blackstoneBreakInfo));

		//TODO: polished blackstone ought to have 2.0 hardness (as per java) but it's 1.5 in Bedrock (probably parity bug)
		$prefix = fn(string $thing) => "Polished Blackstone" . ($thing !== "" ? " $thing" : "");
		self::register("polished_blackstone", fn(int $id) => new Opaque(new BID($id), $prefix(""), $blackstoneBreakInfo));
		self::register("polished_blackstone_button", fn(int $id) => new StoneButton(new BID($id), $prefix("Button"), new Info(BreakInfo::pickaxe(0.5))));
		self::register("polished_blackstone_pressure_plate", fn(int $id) => new StonePressurePlate(new BID($id), $prefix("Pressure Plate"), new Info(BreakInfo::pickaxe(0.5, ToolTier::WOOD)), 20));
		self::register("polished_blackstone_slab", fn(int $id) => new Slab(new BID($id), $prefix(""), $slabBreakInfo));
		self::register("polished_blackstone_stairs", fn(int $id) => new Stair(new BID($id), $prefix("Stairs"), $blackstoneBreakInfo));
		self::register("polished_blackstone_wall", fn(int $id) => new Wall(new BID($id), $prefix("Wall"), $blackstoneBreakInfo));
		self::register("chiseled_polished_blackstone", fn(int $id) => new Opaque(new BID($id), "Chiseled Polished Blackstone", $blackstoneBreakInfo));

		$prefix = fn(string $thing) => "Polished Blackstone Brick" . ($thing !== "" ? " $thing" : "");
		self::register("polished_blackstone_bricks", fn(int $id) => new Opaque(new BID($id), "Polished Blackstone Bricks", $blackstoneBreakInfo));
		self::register("polished_blackstone_brick_slab", fn(int $id) => new Slab(new BID($id), "Polished Blackstone Brick", $slabBreakInfo));
		self::register("polished_blackstone_brick_stairs", fn(int $id) => new Stair(new BID($id), $prefix("Stairs"), $blackstoneBreakInfo));
		self::register("polished_blackstone_brick_wall", fn(int $id) => new Wall(new BID($id), $prefix("Wall"), $blackstoneBreakInfo));
		self::register("cracked_polished_blackstone_bricks", fn(int $id) => new Opaque(new BID($id), "Cracked Polished Blackstone Bricks", $blackstoneBreakInfo));

		self::register("soul_torch", fn(int $id) => new Torch(new BID($id), "Soul Torch", new Info(BreakInfo::instant())));
		self::register("soul_fire", fn(int $id) => new SoulFire(new BID($id), "Soul Fire", new Info(BreakInfo::instant(), [Tags::FIRE])));

		//TODO: soul soul ought to have 0.5 hardness (as per java) but it's 1.0 in Bedrock (probably parity bug)
		self::register("soul_soil", fn(int $id) => new Opaque(new BID($id), "Soul Soil", new Info(BreakInfo::shovel(1.0))));

		self::register("shroomlight", fn(int $id) => new class(new BID($id), "Shroomlight", new Info(new BreakInfo(1.0, ToolType::HOE))) extends Opaque{
			public function getLightLevel() : int{ return 15; }
		});

		self::register("warped_wart_block", fn(int $id) => new Opaque(new BID($id), "Warped Wart Block", new Info(new BreakInfo(1.0, ToolType::HOE))));
		self::register("crying_obsidian", fn(int $id) => new class(new BID($id), "Crying Obsidian", new Info(BreakInfo::pickaxe(35.0 /* 50 in Java */, ToolTier::DIAMOND, 6000.0))) extends Opaque{
			public function getLightLevel() : int{ return 10;}
		});

		self::register("twisting_vines", fn(int $id) => new NetherVines(new BID($id), "Twisting Vines", new Info(BreakInfo::instant()), Facing::UP));
		self::register("weeping_vines", fn(int $id) => new NetherVines(new BID($id), "Weeping Vines", new Info(BreakInfo::instant()), Facing::DOWN));

		$netherRootsInfo = new Info(BreakInfo::instant(), [Tags::POTTABLE_PLANTS]);
		self::register("crimson_roots", fn(int $id) => new NetherRoots(new BID($id), "Crimson Roots", $netherRootsInfo));
		self::register("warped_roots", fn(int $id) => new NetherRoots(new BID($id), "Warped Roots", $netherRootsInfo));

		self::register("chain", fn(int $id) => new Chain(new BID($id), "Chain", new Info(BreakInfo::pickaxe(5.0, ToolTier::WOOD))));
	}

	private static function registerBlocksR17() : void{
		//in java this can be acquired using any tool - seems to be a parity issue in bedrock
		$amethystInfo = new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD));
		self::register("amethyst", fn(int $id) => new class(new BID($id), "Amethyst", $amethystInfo) extends Opaque{
			use AmethystTrait;
		});
		self::register("budding_amethyst", fn(int $id) => new BuddingAmethyst(new BID($id), "Budding Amethyst", $amethystInfo));
		self::register("amethyst_cluster", fn(int $id) => new AmethystCluster(new BID($id), "Amethyst Cluster", $amethystInfo));

		self::register("calcite", fn(int $id) => new Opaque(new BID($id), "Calcite", new Info(BreakInfo::pickaxe(0.75, ToolTier::WOOD))));
		self::register("tuff", fn(int $id) => new Opaque(new BID($id), "Tuff", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));

		self::register("raw_copper", fn(int $id) => new Opaque(new BID($id), "Raw Copper Block", new Info(BreakInfo::pickaxe(5, ToolTier::STONE, 30.0))));
		self::register("raw_gold", fn(int $id) => new Opaque(new BID($id), "Raw Gold Block", new Info(BreakInfo::pickaxe(5, ToolTier::IRON, 30.0))));
		self::register("raw_iron", fn(int $id) => new Opaque(new BID($id), "Raw Iron Block", new Info(BreakInfo::pickaxe(5, ToolTier::STONE, 30.0))));

		$deepslateBreakInfo = new Info(BreakInfo::pickaxe(3, ToolTier::WOOD, 18.0));
		self::register("deepslate", fn(int $id) => new class(new BID($id), "Deepslate", $deepslateBreakInfo) extends SimplePillar{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [VanillaBlocks::COBBLED_DEEPSLATE()->asItem()];
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		});

		//TODO: parity issue here - in Java this has a hardness of 3.0, but in bedrock it's 3.5
		self::register("chiseled_deepslate", fn(int $id) => new Opaque(new BID($id), "Chiseled Deepslate", new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD, 18.0))));

		$deepslateBrickBreakInfo = new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD, 18.0));
		self::register("deepslate_bricks", fn(int $id) => new Opaque(new BID($id), "Deepslate Bricks", $deepslateBrickBreakInfo));
		self::register("deepslate_brick_slab", fn(int $id) => new Slab(new BID($id), "Deepslate Brick", $deepslateBrickBreakInfo));
		self::register("deepslate_brick_stairs", fn(int $id) => new Stair(new BID($id), "Deepslate Brick Stairs", $deepslateBrickBreakInfo));
		self::register("deepslate_brick_wall", fn(int $id) => new Wall(new BID($id), "Deepslate Brick Wall", $deepslateBrickBreakInfo));
		self::register("cracked_deepslate_bricks", fn(int $id) => new Opaque(new BID($id), "Cracked Deepslate Bricks", $deepslateBrickBreakInfo));

		$deepslateTilesBreakInfo = new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD, 18.0));
		self::register("deepslate_tiles", fn(int $id) => new Opaque(new BID($id), "Deepslate Tiles", $deepslateTilesBreakInfo));
		self::register("deepslate_tile_slab", fn(int $id) => new Slab(new BID($id), "Deepslate Tile", $deepslateTilesBreakInfo));
		self::register("deepslate_tile_stairs", fn(int $id) => new Stair(new BID($id), "Deepslate Tile Stairs", $deepslateTilesBreakInfo));
		self::register("deepslate_tile_wall", fn(int $id) => new Wall(new BID($id), "Deepslate Tile Wall", $deepslateTilesBreakInfo));
		self::register("cracked_deepslate_tiles", fn(int $id) => new Opaque(new BID($id), "Cracked Deepslate Tiles", $deepslateTilesBreakInfo));

		$cobbledDeepslateBreakInfo = new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD, 18.0));
		self::register("cobbled_deepslate", fn(int $id) => new Opaque(new BID($id), "Cobbled Deepslate", $cobbledDeepslateBreakInfo));
		self::register("cobbled_deepslate_slab", fn(int $id) => new Slab(new BID($id), "Cobbled Deepslate", $cobbledDeepslateBreakInfo));
		self::register("cobbled_deepslate_stairs", fn(int $id) => new Stair(new BID($id), "Cobbled Deepslate Stairs", $cobbledDeepslateBreakInfo));
		self::register("cobbled_deepslate_wall", fn(int $id) => new Wall(new BID($id), "Cobbled Deepslate Wall", $cobbledDeepslateBreakInfo));

		$polishedDeepslateBreakInfo = new Info(BreakInfo::pickaxe(3.5, ToolTier::WOOD, 18.0));
		self::register("polished_deepslate", fn(int $id) => new Opaque(new BID($id), "Polished Deepslate", $polishedDeepslateBreakInfo));
		self::register("polished_deepslate_slab", fn(int $id) => new Slab(new BID($id), "Polished Deepslate", $polishedDeepslateBreakInfo));
		self::register("polished_deepslate_stairs", fn(int $id) => new Stair(new BID($id), "Polished Deepslate Stairs", $polishedDeepslateBreakInfo));
		self::register("polished_deepslate_wall", fn(int $id) => new Wall(new BID($id), "Polished Deepslate Wall", $polishedDeepslateBreakInfo));

		self::register("tinted_glass", fn(int $id) => new TintedGlass(new BID($id), "Tinted Glass", new Info(new BreakInfo(0.3))));

		//blast resistance should be 30 if we were matched with java :(
		$copperBreakInfo = new Info(BreakInfo::pickaxe(3.0, ToolTier::STONE, 18.0));
		self::register("lightning_rod", fn(int $id) => new LightningRod(new BID($id), "Lightning Rod", $copperBreakInfo));

		self::register("copper", fn(int $id) => new Copper(new BID($id), "Copper Block", $copperBreakInfo));
		self::register("cut_copper", fn(int $id) => new Copper(new BID($id), "Cut Copper Block", $copperBreakInfo));
		self::register("cut_copper_slab", fn(int $id) => new CopperSlab(new BID($id), "Cut Copper Slab", $copperBreakInfo));
		self::register("cut_copper_stairs", fn(int $id) => new CopperStairs(new BID($id), "Cut Copper Stairs", $copperBreakInfo));

		$candleBreakInfo = new Info(new BreakInfo(0.1));
		self::register("candle", fn(int $id) => new Candle(new BID($id), "Candle", $candleBreakInfo));
		self::register("dyed_candle", fn(int $id) => new DyedCandle(new BID($id), "Dyed Candle", $candleBreakInfo));

		//TODO: duplicated break info :(
		$cakeBreakInfo = new Info(new BreakInfo(0.5));
		self::register("cake_with_candle", fn(int $id) => new CakeWithCandle(new BID($id), "Cake With Candle", $cakeBreakInfo));
		self::register("cake_with_dyed_candle", fn(int $id) => new CakeWithDyedCandle(new BID($id), "Cake With Dyed Candle", $cakeBreakInfo));

		self::register("hanging_roots", fn(int $id) => new HangingRoots(new BID($id), "Hanging Roots", new Info(BreakInfo::instant(ToolType::SHEARS, 1))));

		self::register("cave_vines", fn(int $id) => new CaveVines(new BID($id), "Cave Vines", new Info(BreakInfo::instant())));

		self::register("small_dripleaf", fn(int $id) => new SmallDripleaf(new BID($id), "Small Dripleaf", new Info(BreakInfo::instant(ToolType::SHEARS, toolHarvestLevel: 1))));
		self::register("big_dripleaf_head", fn(int $id) => new BigDripleafHead(new BID($id), "Big Dripleaf", new Info(BreakInfo::instant())));
		self::register("big_dripleaf_stem", fn(int $id) => new BigDripleafStem(new BID($id), "Big Dripleaf Stem", new Info(BreakInfo::instant())));
	}

	private static function registerBlocksR18() : void{
		self::register("spore_blossom", fn(int $id) => new SporeBlossom(new BID($id), "Spore Blossom", new Info(BreakInfo::instant())));
	}

	private static function registerMudBlocks() : void{
		self::register("mud", fn(int $id) => new Opaque(new BID($id), "Mud", new Info(BreakInfo::shovel(0.5), [Tags::MUD])));
		self::register("packed_mud", fn(int $id) => new Opaque(new BID($id), "Packed Mud", new Info(BreakInfo::pickaxe(1.0, null, 15.0))));

		$mudBricksBreakInfo = new Info(BreakInfo::pickaxe(2.0, ToolTier::WOOD, 30.0));

		self::register("mud_bricks", fn(int $id) => new Opaque(new BID($id), "Mud Bricks", $mudBricksBreakInfo));
		self::register("mud_brick_slab", fn(int $id) => new Slab(new BID($id), "Mud Brick", $mudBricksBreakInfo));
		self::register("mud_brick_stairs", fn(int $id) => new Stair(new BID($id), "Mud Brick Stairs", $mudBricksBreakInfo));
		self::register("mud_brick_wall", fn(int $id) => new Wall(new BID($id), "Mud Brick Wall", $mudBricksBreakInfo));
	}

	private static function registerCauldronBlocks() : void{
		$cauldronBreakInfo = new Info(BreakInfo::pickaxe(2, ToolTier::WOOD));

		self::register("cauldron", fn(int $id) => new Cauldron(new BID($id, TileCauldron::class), "Cauldron", $cauldronBreakInfo));
		self::register("water_cauldron", fn(int $id) => new WaterCauldron(new BID($id, TileCauldron::class), "Water Cauldron", $cauldronBreakInfo));
		self::register("lava_cauldron", fn(int $id) => new LavaCauldron(new BID($id, TileCauldron::class), "Lava Cauldron", $cauldronBreakInfo));
		self::register("potion_cauldron", fn(int $id) => new PotionCauldron(new BID($id, TileCauldron::class), "Potion Cauldron", $cauldronBreakInfo));
	}
}
